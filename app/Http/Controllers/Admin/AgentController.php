<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;

use App\Models\Agent;
use App\Models\User;
use App\Models\Site;
use App\Models\Setting;
use App\Models\Bank;
use App\Models\Code;

class AgentController extends BaseController
{
    //
    public function __construct()
    {
        parent::__construct();
    }
    public function settings(Request $request)
    {
        $page_title = '설정 및 정보';

        $authUser = \Auth::guard('admin')->user();
        $ancestry_ids = explode('/', trim($authUser->ancestry, '/'));
        $parents = array();
        foreach ($ancestry_ids as $ancestry_id) {
            $parent = Agent::where('id', $ancestry_id)->first();
            if ($parent && $parent->parent_level >= $authUser->parent_level - 1)
                $parents[] = $parent;
        }
        
        $child_users_cnt = User::all()->count();

        return view('admin.agent.settings', compact('page_title', 'child_users_cnt'));
    }
    public function changepassword(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($request->isMethod('patch')) {
            if (!\Hash::check($request->old_password, $authUser->password)) {
                session()->flash('error', '기존 패스워드가 맞지 않습니다.');
                return redirect()->back();
            }

            $validator = \Validator::make($request->all(), [
                'old_password' => ['required'],
                'new_password' => ['required', 'string', 'min:4', 'max:255', 'confirmed'],
            ], [
                'required' => ':attribute 필드는 필수입니다.',
                'string' => ':attribute 필드는 문자열이어야 합니다.',
                'min' => ':attribute 필드는 최소한 :min자이어야 합니다.',
                'max' => ':attribute 필드는 :max자보다 클수 없습니다.',
                'confirmed' => '새 비밀번호 확인 항목이 일치하지 않습니다.'
            ], [
                'old_password' => '현재 비밀번호',
                'new_password' => '새 비밀번호',
            ]);
    
            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator->errors());
            }

            $authUser->password = $request->new_password;
            $authUser->password_original = $request->new_password;
            $authUser->save();

            session()->flash('success', '패스워드가 변경되었습니다.');
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
    public function banks(Request $request)
    {
        $page_title = '은행관리';
        $query = Bank::query();
        $bankName = $request->query('bankName');
        if (!empty($bankName))
             $query->where('name','LIKE', '%'.$bankName.'%');
        $banks = $query->paginate(20);
        return view('admin.agent.banks', compact('page_title', 'banks','bankName'));
    }
    public function bankcreate(Request $request){
       
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:4', 'max:255', 'unique:banks']
        ], [
            'required' => ':attribute 필드는 필수입니다.',
            'string' => ':attribute 필드는 문자열이어야 합니다.',
            'min' => ':attribute 필드는 최소한 :min자이어야 합니다.',
            'max' => ':attribute 필드는 :max자보다 클수 없습니다.',
            'regex' => '유효하지 않은 :attribute 입니다.',
            'unique' => ':attribute 은(는) 이미 사용 중입니다.'
        ], [
            'name' => '은행명'
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        $bank = new Bank;
        $bank->name = $request->name;
        $bank->updated_at = date('Y-m-d H:i:s');
        $bank->created_at = date('Y-m-d H:i:s');
        $result = $bank->save();

        if ($result) {
            session()->flash('success', '은행명이 생성되었습니다.');
            return redirect()->back();
        }
        else {
            session()->flash('error', '은행명 생성이 실패되었습니다.');
            return redirect()->back();
        }
    }
    public function bankedit(Request $request, $id)
    {
        $page_title = '추천코드 수정';        
        $bank = Bank::where('id', $id)->first();
        if (!$bank) {
            session()->flash('error', '은행이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('put')) {
            if (!empty($request->bank)) {
                $bank_length = strlen($request->bank);
                if ($bank_length < 4) {
                    session()->flash('error', '추천코드는 4자이어야 합니다.');
                    return redirect()->back()->withInput();
                }
                else if ($bank_length > 255) {
                    session()->flash('error', '추천코드는 255자보다 클수 없습니다.');
                    return redirect()->back()->withInput();
                }  
            }            
            $bank->name = $request->bank;          
            $bank->save();
            session()->flash('success', '추천코드를 수정했습니다.');
        }       
        return view('admin.bank.edit', compact('page_title', 'bank'));
    }

    public function bankprocess(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        $bank = Bank::where('id',$id)->first();
        if ($request->isMethod('post')) {
            $param = $request->param;
            switch ($param) {
                // case 'approve':
                //     session()->flash('success', $user->identity.' 님의 계정을 승인하였습니다.');
                //     $user->status = 1;
                //     break;
                // case 'block':
                //     session()->flash('success', $user->identity.' 님의 계정을 차단하였습니다.');
                //     $user->status = 2;
                //     break;
                // case 'unblock':
                //     session()->flash('success', $user->identity.' 님의 계정을 차단해제하였습니다.');
                //     $user->status = 1;
                //     break;
                case 'delete':
                    session()->flash('success', '은행 '.$bank->name.' 를 삭제하였습니다.');
                    $bank->delete();
                    break;
            }

            if ($param != 'delete') {
                $bank->updated_at = date('Y-m-d H:i:s');
                $bank->save();
            }
            
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }

    public function codes(Request $request)
    {
        $page_title = '추천코드관리';
        $query = Code::query();
        $codeName = $request->query('codeName');
        
        if (!empty($codeName))
             $query->where('code','LIKE', '%'.$codeName.'%');
        $codes = $query->paginate(20);
        return view('admin.agent.codes', compact('page_title', 'codes','codeName'));
    }
    public function codecreate(Request $request){
       
        $validator = \Validator::make($request->all(), [
            'code' => ['required', 'string', 'min:4', 'max:255', 'unique:codes']
        ], [
            'required' => ':attribute 필드는 필수입니다.',
            'string' => ':attribute 필드는 문자열이어야 합니다.',
            'min' => ':attribute 필드는 최소한 :min자이어야 합니다.',
            'max' => ':attribute 필드는 :max자보다 클수 없습니다.',
            'regex' => '유효하지 않은 :attribute 입니다.',
            'unique' => ':attribute 은(는) 이미 사용 중입니다.'
        ], [
            'code' => '추천코드'
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        $code = new Code;
        $code->code = $request->code;
        $code->updated_at = date('Y-m-d H:i:s');
        $code->created_at = date('Y-m-d H:i:s');
        $result = $code->save();

        if ($result) {
            session()->flash('success', '추천코드가 생성되었습니다.');
            return redirect()->back();
        }
        else {
            session()->flash('error', '추천코드 생성이 실패되었습니다.');
            return redirect()->back();
        }
    }
    public function codeedit(Request $request, $id)
    {
        $page_title = '추천코드 수정';        
        $code = Code::where('id', $id)->first();
        if (!$code) {
            session()->flash('error', '추천코드가 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('put')) {
            if (!empty($request->code)) {
                $code_length = strlen($request->code);
                if ($code_length < 4) {
                    session()->flash('error', '추천코드는 4자이어야 합니다.');
                    return redirect()->back()->withInput();
                }
                else if ($code_length > 255) {
                    session()->flash('error', '추천코드는 255자보다 클수 없습니다.');
                    return redirect()->back()->withInput();
                }  
            }            
            $code->code = $request->code;          
            $code->save();
            session()->flash('success', '추천코드를 수정했습니다.');
        }       
        return view('admin.code.edit', compact('page_title', 'code'));
    }

    public function codeprocess(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        $code = Code::where('id',$id)->first();
        if ($request->isMethod('post')) {
            $param = $request->param;
            switch ($param) {
                // case 'approve':
                //     session()->flash('success', $user->identity.' 님의 계정을 승인하였습니다.');
                //     $user->status = 1;
                //     break;
                // case 'block':
                //     session()->flash('success', $user->identity.' 님의 계정을 차단하였습니다.');
                //     $user->status = 2;
                //     break;
                // case 'unblock':
                //     session()->flash('success', $user->identity.' 님의 계정을 차단해제하였습니다.');
                //     $user->status = 1;
                //     break;
                case 'delete':
                    session()->flash('success', '추천코드 '.$code->code.' 를 삭제하였습니다.');
                    $code->delete();
                    break;
            }

            if ($param != 'delete') {
                $code->updated_at = date('Y-m-d H:i:s');
                $code->save();
            }
            
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }

}
