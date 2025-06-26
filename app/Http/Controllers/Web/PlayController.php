<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function lotto_pb(){
        return view('web.game.pbW');
    }
}
