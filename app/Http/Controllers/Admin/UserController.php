<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;
use Carbon\Carbon;
use App\Models\Agent;
use App\Models\User;
use App\Models\Site;
use App\Models\Bank;
use App\Models\Depowith;
class UserController extends BaseController
{
    public function __construct(){
        parent::__construct();
    }
    public function index(Request $request)
    {
       $page_title = '유저 목록';

        $authUser = \Auth::guard('admin')->user();
        $identity = $request->query('identity');
        $name =  $request->query('name');
        $myusers = User::query();
        if(!empty($identity))
        {
            $myusers  = $myusers->where('identity','LIKE', '%'.$identity.'%');
        }
        if(!empty($name))
        {
            $myusers  = $myusers->where('name','LIKE', '%'.$name.'%');
        }
        $myusers  = $myusers->orderBy('users.created_at', 'DESC')->paginate(20);
        foreach ($myusers as $user) {
            $user->total_deposit = Depowith::where('user_id', $user->id)
                ->where('type', 0)
                ->where('status', 1)
                ->sum('amount');

            $user->total_withdrawal = Depowith::where('user_id', $user->id)
                ->where('type', 1)
                ->where('status', 1)
                ->sum('amount');
            $user->profit = $user->total_deposit - $user->total_withdrawal;
        }
        return view('admin.user.index', compact('page_title', 'myusers', 'identity','name'));

    }

    public function onlineusers(Request $request)
    {
        $page_title = '접속자 목록';

        $authUser = \Auth::guard('admin')->user();
        $identity = $request->query('identity');
        $name =  $request->query('name');
        $myusers = User::query();
        if(!empty($identity))
        {
            $myusers  = $myusers->where('identity','LIKE', '%'.$identity.'%');
        }
        if(!empty($name))
        {
            $myusers  = $myusers->where('name','LIKE', '%'.$name.'%');
        }
        $myusers  = $myusers->where('users.last_access_at', '>=', Carbon::now()->subSeconds(20))->orderBy('users.created_at', 'DESC')->paginate(20);
        foreach ($myusers as $user) {
            $user->total_deposit = Depowith::where('user_id', $user->id)
                ->where('type', 0)
                ->where('status', 1)
                ->sum('amount');

            $user->total_withdrawal = Depowith::where('user_id', $user->id)
                ->where('type', 1)
                ->where('status', 1)
                ->sum('amount');
            $user->profit = $user->total_deposit - $user->total_withdrawal;
        }
        return view('admin.user.onlineusers', compact('page_title', 'myusers', 'identity','name'));
    }
    public function create(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        /*if ($authUser->parent_level > 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }*/

        $validator = \Validator::make($request->all(), [
            'identity' => ['required', 'string', 'min:4', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'max:255'],
        ], [
            'required' => ':attribute 필드는 필수입니다.',
            'string' => ':attribute 필드는 문자열이어야 합니다.',
            'min' => ':attribute 필드는 최소한 :min자이어야 합니다.',
            'max' => ':attribute 필드는 :max자보다 클수 없습니다.',
            'regex' => '유효하지 않은 :attribute 입니다.',
            'unique' => ':attribute 은(는) 이미 사용 중입니다.'
        ], [
            'identity' => '아이디',
            'name' => '이름',
            'password' => '비밀번호',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        
        $user = new User;
        $user->identity = $request->identity;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->password_original = $request->password; 
        $user->status = 0;
        $user->level = 0;
        $user->code = $request->code;
        $user->amount = 0;
        $user->bank_name = $request->bankName;
        $user->bank_num = $request->bank;
        $user->bank_owner = $request->bankOwner;
        $user->phone = $request->phone;

        $user->updated_at = date('Y-m-d H:i:s');
        $user->created_at = date('Y-m-d H:i:s');
        $result = $user->save();

        if ($result) {
            session()->flash('success', '유저가 생성되었습니다.');
            return redirect()->back();
        }
        else {
            session()->flash('error', '유저 생성이 실패되었습니다.');
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $page_title = '유저 수정';
        $banks = Bank::all();
        $authUser = \Auth::guard('admin')->user();
      
        $user = User::where('id', $id)->first();
        if (!$user) {
            session()->flash('error', '유저가 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('put')) {
            if (!empty($request->password)) {
                $password_length = strlen($request->password);
                if ($password_length < 4) {
                    session()->flash('error', '비밀번호는 최소한 4자이어야 합니다.');
                    return redirect()->back()->withInput();
                }
                else if ($password_length > 255) {
                    session()->flash('error', '비밀번호는 255자보다 클수 없습니다.');
                    return redirect()->back()->withInput();
                }                    
                $user->password = $request->password;
                $user->password_original = $request->password;
                $user->amount =  str_replace(',', '', $request->amount);
                $user->bank_name = $request->bank_name;
                $user->bank_num = $request->bank_num;
                $user->bank_owner = $request->bank_owner;
                $user->phone = $request->phone;
            }

          
            $user->save();

            session()->flash('success', '유저 '.$user->nickname.' (@'.$user->identity.')를 수정했습니다.');
        }
       
        return view('admin.user.edit', compact('page_title', 'user', 'banks'));
    }

    public function process(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level < 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }
        $user = User::where('id', $id)->first();
        if (!$user) {
            session()->flash('error', '유저가 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('post')) {
            $param = $request->param;
            switch ($param) {
                case 'approve':
                    session()->flash('success', $user->identity.' 님의 계정을 승인하였습니다.');
                    $user->status = 1;
                    break;
                case 'block':
                    session()->flash('success', $user->identity.' 님의 계정을 차단하였습니다.');
                    $user->status = 2;
                    break;
                case 'unblock':
                    session()->flash('success', $user->identity.' 님의 계정을 차단해제하였습니다.');
                    $user->status = 1;
                    break;
                case 'delete':
                    session()->flash('success', $user->identity.' 님의 계정을 삭제하였습니다.');
                    $user->delete();
                    break;
            }

            if ($param != 'delete') {
                $user->updated_at = date('Y-m-d H:i:s');
                $user->save();
            }
            
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
