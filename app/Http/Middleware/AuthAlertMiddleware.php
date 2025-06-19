<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthAlertMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return response()->make('
                <script>
                    alert("로그인이 필요합니다.");
                    history.back();
                </script>
            ', 200, ['Content-Type' => 'text/html; charset=UTF-8']);
        }

        return $next($request);
    }
}
