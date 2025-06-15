<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
