<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class BaseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:web');

        $this->middleware(function ($request, $next) {
            $authUser = \Auth::guard('web')->user();

            if ($authUser) {
                $unreadMessage = Message::where('user_id', $authUser->id)
                    ->where('status', 0)
                    ->latest()
                    ->first();

                \View::share(compact('unreadMessage'));
            }

            return $next($request);
        });
    }
}