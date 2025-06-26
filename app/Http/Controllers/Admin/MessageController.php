<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $page_title = '쪽지 목록';

        $authUser = \Auth::guard('admin')->user();

        $messages = Message::query()
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('messages.*', 'users.identity', 'users.name');
        $identity = $request->identity;
        if (!empty($request->identity)) {
            $messages->where('users.identity', 'LIKE', '%' . $request->identity . '%');
        }
        $name = $request->name;
        if (!empty($request->name)) {
            $messages->where('users.name', 'LIKE', '%' . $request->name . '%');
        }

        $page_size = 20;
        if (!empty($request->page_size)) {
            $page_size = $request->page_size;
        }

        $messages = $messages->orderBy('messages.created_at', 'DESC')->paginate($page_size);

        // $authUser->parent_level 은 그대로 사용
        if ($authUser->parent_level == 0) {
            // join 으로 identity, name 가져왔기 때문에 loop 불필요
        }

        $partial_view = view('admin.message.index_partial', compact('messages', 'page_size','identity', 'name'))->render();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'html' => $partial_view]);
        } else {
            return view('admin.message.index', compact('page_title', 'partial_view'));
        }   
    }

    public function send(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
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
        
        $receiver_name = '';
        switch ($request->receiver_type) {
           
            case 'users':
                $receiver_name = '전체 유저';
                $users = User::where('status', 1);
                if (!empty($request->receiver_identity))
                    $users = $users->where('identity', $request->receiver_identity);
                $receivers = $users->select('id', 'identity', 'name')->get();
                if (!empty($request->receiver_identity))
                    $receiver_name = empty($receivers) ? '' : $receivers[0]->name.' (@'.$receivers[0]->identity.') 님';
                break;            
            default:
                return response()->json(['success' => false, 'msg' => '비법적인 호출입니다.'], 200, [], JSON_UNESCAPED_UNICODE);
                break;
        }
        
        if (empty($receivers))
            return response()->json(['success' => false, 'msg' => '쪽지 수신자가 존재하지 않습니다.']);

        $messages = [];
        foreach ($receivers as $receiver) {
            $messages[] = [
                'user_id' => $authUser->id,
                'status' => 0,
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $receiver->id,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        $result = Message::insert($messages);
        if ($result)
            return response()->json(['success' => true, 'msg' => $receiver_name.'에게 쪽지를 전송했습니다.']);
        else
            return response()->json(['success' => false, 'msg' => $receiver_name.'에게 쪽지전송이 실패되었습니다.']);
    }

    public function read(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();

        $message = Message::where(['id' => $id])->first();
        if (!$message) {
            return response()->json(['success' => false, 'msg' => '쪽지가 존재하지 않습니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $html = view('admin.message.detail', compact('message'))->render();
        
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function readall(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level == 0) {
            return response()->json(['success' => false, 'msg' => '비법적인 호출입니다.'], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $messages = Message::where('status', 0)->where(function ($query) use ($authUser) {
            $query->where(['sender_id' => $authUser->id])
                ->orWhere(function($sub_query) use ($authUser) { $sub_query->where(['receiver_id' => $authUser->id, 'receiver_type' => 0]); });
        })->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
        
        return response()->json(['success' => true, 'msg' => '전체 쪽지를 읽기하였습니다.']);
    }

    public function delete(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();

        $message = Message::where('id', $id)->first();
        if (!$message) {
            session()->flash('error', '쪽지가 존재하지 않습니다.');
            return abort(404);
        }

        if ($request->isMethod('delete')) {
            if ($authUser->parent_level > 0 &&  $message->receiver_id != $authUser->id && $message->receiver_type != 0) {
                session()->flash('error', '귀하의 권한이 부족합니다.');
                return redirect()->back();
            }

            $message->delete();
            session()->flash('success', '쪽지를 삭제했습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }

    public function deleteall(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();

        if ($request->isMethod('delete')) {
            $messages = Message::whereRaw('1=1');
            if ($authUser->parent_level > 0) {
                $messages = $messages->where(function ($query) use ($authUser) {
                    $query->where(['sender_id' => $authUser->id])
                        ->orWhere(function($sub_query) use ($authUser) { $sub_query->where(['receiver_id' => $authUser->id, 'receiver_type' => 0]); });
                });
            }

            $messages->delete();
            session()->flash('success', '전체 쪽지를 삭제했습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
