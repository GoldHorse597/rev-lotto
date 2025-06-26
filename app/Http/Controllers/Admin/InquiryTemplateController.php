<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InquiryTemplate;


class InquiryTemplateController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $page_title = '1:1문의 답변 목록';

        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }

        $inquiryTemplates = new InquiryTemplate;
        if (!empty($request->title))
            $inquiryTemplates = $inquiryTemplates->where('title', 'LIKE', $request->title.'%');
        
        $page_size = 10;
        if (!empty($request->page_size))
            $page_size = $request->page_size;
        $inquiryTemplates = $inquiryTemplates->orderBy('created_at', 'DESC')->paginate($page_size);

        $partial_view = view('admin.inquirytemplate.index_partial', compact('inquiryTemplates', 'page_size'))->render();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'html' => $partial_view]);
        }
        else {
            return view('admin.inquirytemplate.index', compact('page_title', 'partial_view'));
        }
    }

    public function create(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
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
            return redirect()->back()->withErrors($validator->errors());
        }
        
        $inquiryTemplate = new InquiryTemplate;
        $inquiryTemplate->title = $request->title;
        $inquiryTemplate->content = $request->content;
        $inquiryTemplate->status = $request->status;
        $inquiryTemplate->updated_at = date('Y-m-d H:i:s');
        $inquiryTemplate->created_at = date('Y-m-d H:i:s');
        $result = $inquiryTemplate->save();

        if ($result) {
            session()->flash('success', '문의 답변글을 추가하였습니다.');
            return redirect()->back();
        }
        else {
            session()->flash('error', '문의 답변글 추가가 실패되었습니다.');
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            return response()->json(['success' => false, 'msg' => '귀하의 권한이 부족합니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
        $inquiryTemplate = InquiryTemplate::where('id', $id)->first();
        if (!$inquiryTemplate) {
            return response()->json(['success' => false, 'msg' => '문의 답변글이 존재하지 않습니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $validator = \Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
            'status' => ['required'],
        ], [
            'required' => ':attribute 필드는 필수입니다.',
        ], [
            'title' => '제목',
            'content' => '내용',
            'status' => '상태',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            return response()->json(['success' => false, 'msg' => implode('\r\n', $messages)], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $inquiryTemplate->title = $request->title;
        $inquiryTemplate->content = $request->content;
        $inquiryTemplate->status = $request->status;
        $inquiryTemplate->updated_at = date('Y-m-d H:i:s');
        $inquiryTemplate->save();

        return response()->json(['success' => true, 'msg' => '문의 답변글을 수정하였습니다.'], 200, [], JSON_UNESCAPED_UNICODE);
    }
    
    public function delete(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }
        $inquiryTemplate = InquiryTemplate::where('id', $id)->first();
        if (!$inquiryTemplate) {
            session()->flash('error', '문의 답변글이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('delete')) {            
            $inquiryTemplate->delete();
            session()->flash('success', '문의 답변글을 삭제했습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
