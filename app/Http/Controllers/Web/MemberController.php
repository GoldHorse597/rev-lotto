<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Code;

class MemberController extends Controller
{
    //
    public function login()
    {
        return view('web.member.login');
    }
    public function join()
    {
        $banks = Bank::all();
        return view('web.member.join',compact('banks'));
    }
    public function id_find()
    {
        return view('web.member.idfind');
    }
    public function password_find()
    {
        return view('web.member.passwordfind');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('identity', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // 로그인 성공 시 → "/" 랜딩페이지로 이동
            $user = Auth::user();
            if ($user->status == '0') {
                Auth::logout();

                return back()->withErrors('승인 대기중인 계정입니다. 관리자의 승인을 기다려 주세요.');
            }
            else if($user->status == '2')
            {
                 Auth::logout();
                return back()->withErrors('정지된 계정입니다. 관리자에게 문의하세요.');
            }
            $user->last_access_ip = $request->getClientIp();
            $user->last_access_at = date('Y-m-d H:i:s');    
            $user->save();
            return redirect()->route('web.index');
        } else {
            return back()->withErrors('로그인 정보가 일치하지 않습니다.');
        }
    }
    public function idCheck(Request $request){
        $id = $request->input('id');
        $exists = User::where('identity', $id)->exists();

        if ($exists) {
            return response('N'); // 이미 사용중
        } else {
            return response('Y'); // 사용 가능
        }
    }
    public function codeCheck(Request $request){
        $code = $request->input('code');
        $exists = Code::where('code', $code)->exists();

        if ($exists) {
            return response('Y'); // 추천코드가 있다면
        } else {
            return response('N'); // 없다면
        }
    }
    public function register(Request $request){
        $exists = User::where('identity', $request->userid1)->exists();

        if ($exists) {
            return back()->withErrors('가입 정보가 정확하지 않습니다.');
        }
        $user = new User;
        $user->identity = $request->userid1;
        $user->name = $request->name;
        $user->password = $request->passwd;
        $user->password_original = $request->passwd;
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
        return view('web.member.login');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        return redirect()->route('web.index');
    }

    public function heartbeat(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $authUser->last_access_at = date('Y-m-d H:i:s');
        $authUser->save();
        return response()->json(['status' => 'ok']);
    }
    public function grade(){
         return view('web.member.grade');
    }
}
