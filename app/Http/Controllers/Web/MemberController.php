<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function login()
    {
        return view('web.member.login');
    }
    public function join()
    {
        return view('web.member.join');
    }
    public function id_find()
    {
        return view('web.member.idfind');
    }
    public function password_find()
    {
        return view('web.member.passwordfind');
    }

    public function getUser(Request $request){

    }
    public function register(Request $request){

    }
    public function id_find_post(Request $request){

    }
    public function password_find_post(Request $request){

    }
}
