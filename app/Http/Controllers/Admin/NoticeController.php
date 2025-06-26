<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;

use App\Models\Notice;

class NoticeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $page_title = '공지사항 목록';

        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }

        $notices = new Notice;
        if (!empty($request->title))
            $notices = $notices->where('title', 'LIKE', $request->title.'%');
        
        $page_size = 10;
        if (!empty($request->page_size))
            $page_size = $request->page_size;
        $notices = $notices->orderBy('created_at', 'DESC')->paginate($page_size);

        $partial_view = view('admin.notice.index_partial', compact('notices', 'page_size'))->render();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'html' => $partial_view]);
        }
        else {
            return view('admin.notice.index', compact('page_title', 'partial_view'));
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
        
        $notice = new Notice;
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->status = $request->status;
        $notice->updated_at = date('Y-m-d H:i:s');
        $notice->created_at = date('Y-m-d H:i:s');
        $result = $notice->save();

        if ($result) {
            session()->flash('success', '공지사항을 추가하였습니다.');
            return redirect()->back();
        }
        else {
            session()->flash('error', '공지사항 추가가 실패되었습니다.');
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $page_title = '공지사항 수정';

        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }
        $notice = Notice::where('id', $id)->first();
        if (!$notice) {
            session()->flash('error', '공지사항이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('put')) {
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
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
            
            $notice->title = $request->title;
            $notice->content = $request->content;
            $notice->status = $request->status;
            $notice->created_at = $request->create_at;
            $notice->updated_at = date('Y-m-d H:i:s');
            $notice->save();

            session()->flash('success', '공지사항을 수정했습니다.');
        }

        return view('admin.notice.edit', compact('page_title', 'notice'));
    }
    
    public function delete(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }
        $notice = Notice::where('id', $id)->first();
        if (!$notice) {
            session()->flash('error', '공지사항이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('delete')) {            
            $notice->delete();
            session()->flash('success', '공지사항을 삭제했습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
