<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    //
    public function lotto_pb()
    {
        return view('web.info.pb');
    }
    public function lotto_mm()
    {
        return view('web.info.mm');
    }
}
