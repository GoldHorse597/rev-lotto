<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Agent;
use App\Models\AgentLoginLog;

class AuthController extends Controller
{
    //
    public function __construct()
    {        
        $this->middleware('guest:admin')->except('logout');
        $this->middleware(function ($request, $next) {
            $app_name = config('app.name');            
            $layout = 'auth';
            
            \View::share(compact('app_name', 'layout'));

            return $next($request);
        });
    }
    public function postLogin(Request $request)
    {
        $agentLoginLog = new AgentLoginLog;
        $agentLoginLog->agent_id = 0;
        $agentLoginLog->login_ip = $request->getClientIp();
        $agentLoginLog->request = json_encode([
            'param' => $request->all(),
            'header' => $request->header('User-Agent')
        ]);
        $agentLoginLog->updated_at = date('Y-m-d H:i:s');
        $agentLoginLog->created_at = date('Y-m-d H:i:s');
        
        $validator = $request->verify();
        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            $agentLoginLog->status = 0;
            $agentLoginLog->response = json_encode(['message' => $messages]);
            $agentLoginLog->save();
            return redirect()->back()->withErrors($messages);
        }
        
        $param = $request->only(['identity', 'password']);
        if (!\Auth::guard('admin')->attempt($param, $request->remember_me == 'on')) 
        {
            $message = '로그인정보가 일치하지 않습니다.';
            $agentLoginLog->status = 0;
            $agentLoginLog->response = json_encode(['message' => $message]);
            $agentLoginLog->save();
            return redirect()->back()->withErrors($message);
        }

        $agent = \Auth::guard('admin')->user();
       
        $agent->last_access_ip = $request->getClientIp();
        $agent->last_access_at = date('Y-m-d H:i:s');        
        $agent->save();
        
        $agentLoginLog->agent_id = $agent->id;
        $agentLoginLog->status = 1;
        $agentLoginLog->response = json_encode(['message' => 'OK']);
        $agentLoginLog->save();

        return redirect()->route('admin.dashboard');
    }
    public function getLogin(Request $request)
    {
        $page_title = trans('admin/auth.login');

        return view('admin.auth.login', compact('page_title'));
    }
    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();

        return redirect()->route('admin.login.get');
    }
}
