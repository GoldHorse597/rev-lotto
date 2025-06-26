<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\InquiryTemplate;
class InquiryController extends BaseController
{
    //
    public function index(Request $request)
    {
        $page_title = '1:1문의 목록';

        $authUser = \Auth::guard('admin')->user();
        
        $inquiries = new Inquiry;
        if ($authUser->parent_level == 0) {
            $inquiries = $inquiries->where('referer_id', 0);
        }
        else {
            $inquiries = $inquiries->where(['sender_id' => \Auth::user()->id]);
        }

        if (!empty($request->title))
            $inquiries = $inquiries->where('title', 'LIKE', $request->title.'%');
        
        $page_size = 10;
        if (!empty($request->page_size))
            $page_size = $request->page_size;
        $inquiries = $inquiries->orderBy('created_at', 'DESC')->paginate($page_size);

        if ($authUser->parent_level == 0) {
            foreach ($inquiries as $inquiry) {
                $sender = User::where('id', $inquiry->sender_id)->first();
                $inquiry->sender_identity = $sender->identity;
                $inquiry->sender_nickname = $sender->name;
            }
        }

        $partial_view = view('admin.inquiry.index_partial', compact('inquiries', 'page_size'))->render();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'html' => $partial_view]);
        }
        else {
            return view('admin.inquiry.index', compact('page_title', 'partial_view'));
        }
    }

    public function send(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level == 0) {
            return response()->json(['success' => false, 'msg' => '비법적인 호출입니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $validator = \Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required']
        ], [
            'required' => ':attribute 필드는 필수입니다.',
        ], [
            'title' => '제목',
            'content' => '내용'            
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            return response()->json(['success' => false, 'msg' => implode('\r\n', $messages)]);
        }

        $inquiry = new Inquiry;
        $inquiry->sender_id = \Auth::user()->id;
        $inquiry->title = $request->title;
        $inquiry->content = $request->content;
        $inquiry->status = 0;
        $inquiry->updated_at = date('Y-m-d H:i:s');
        $inquiry->created_at = date('Y-m-d H:i:s');
        $inquiry->save();


        return response()->json(['success' => true, 'msg' => '문의를 전송했습니다.']);
    }

    public function read(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();

        $inquiry = Inquiry::where(['id' => $id, 'inquiries.referer_id' => 0])->first();
        if (!$inquiry) {
            return response()->json(['success' => false, 'msg' => '문의가 존재하지 않습니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        if ($authUser->parent_level == 0)
        {
            if ($inquiry->status == 0) {
                $inquiry->status = 1;
                $inquiry->updated_at = date('Y-m-d H:i:s');
                $inquiry->save();
            }
        }
        else {
            if ($inquiry->sender_id != $authUser->id ) {
                return response()->json(['success' => false, 'msg' => '비법적인 호출입니다.'], 200, [], JSON_UNESCAPED_UNICODE);
            }
            $reply_inquiries = Inquiry::where(['referer_id' => $id, 'status' => 0])
                ->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
        }

        $reply_inquiries = Inquiry::where('referer_id', $id)->get();
        $inquiry_templates = InquiryTemplate::where('status', 1)->get();

        $html = view('admin.inquiry.detail', compact('reply_inquiries', 'inquiry', 'inquiry_templates'))->render();
        
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function readall(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();

        if ($authUser->parent_level == 0) {
            $inquiries = Inquiry::where(['referer_id' => 0, 'status' => 0])
                ->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

            return response()->json(['success' => true, 'msg' => '전체 1:1문의를 읽기하였습니다.']);
        }
        else {
            $inquiry_ids = Inquiry::where(['sender_id' => $authUser->id])->pluck('id');
            $reply_inquiries = Inquiry::whereIn('referer_id', $inquiry_ids)->where('status', 0)
                ->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
            
            return response()->json(['success' => true, 'msg' => '전체 1:1문의답변을 읽기하였습니다.']);
        }
    }

    public function reply(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            return response()->json(['success' => false, 'msg' => '귀하의 권한이 부족합니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $inquiry = Inquiry::where('id', $id)->first();
        if (!$inquiry) {
            return response()->json(['success' => false, 'msg' => '문의가 존재하지 않습니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        if ($inquiry->reply_id) {
            return response()->json(['success' => false, 'msg' => '이미 답변하였습니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $validator = \Validator::make($request->all(), [
            'content' => ['required']
        ], [
            'required' => ':attribute 필드는 필수입니다.',
        ], [
            'content' => '내용'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            return response()->json(['success' => false, 'msg' => implode('\r\n', $messages)], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $reply_inquiry = new Inquiry;
        $reply_inquiry->sender_id = $authUser->id;
        $reply_inquiry->title = '';
        $reply_inquiry->content = $request->content;
        $reply_inquiry->referer_id = $id;
        $reply_inquiry->updated_at = date('Y-m-d H:i:s');
        $reply_inquiry->created_at = date('Y-m-d H:i:s');
        $result = $reply_inquiry->save();

        $inquiry->status = 2;
        $inquiry->save();
        
        return response()->json(['success' => true, 'msg' => ''], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function delete(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();

        $inquiry = Inquiry::where('id', $id)->first();
        if (!$inquiry) {
            session()->flash('error', '1:1문의가 존재하지 않습니다.');
            return abort(404);
        }
        
        if ($request->isMethod('delete')) {
            if ($authUser->parent_level > 0 &&  $inquiry->sender_id != $authUser->id ) {
                session()->flash('error', '귀하의 권한이 부족합니다.');
                return redirect()->back();
            }

            $inquiry->delete();
            Inquiry::where('referer_id', $id)->delete();
            session()->flash('success', '1:1문의를 삭제했습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }

    public function deleteall(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();

        if ($request->isMethod('delete')) {
            $inquiries = Inquiry::whereRaw('1=1');
            if ($authUser->parent_level > 0) {
                $inquiries = $inquiries->where(['sender_id' => $authUser->id]);
            }

            $inquiries->delete();
            session()->flash('success', '전체 1:1문의를 삭제했습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
