<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteIsClosed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $_setting = \App\Models\Setting::first();
        if (env('USER')) {
            if ($_setting->site_closed > 0)
                return response()->view('web.'.env('THEME').'.site_closed', compact('_setting'), 200)->header('Content-Type', 'text/html');

            $forbidden_ips = explode("\n", $_setting->user_forbidden_ip);
            $client_ip = $request->getClientIp();
            if (in_array($client_ip, $forbidden_ips))
                return response()->view('web.'.env('THEME').'.forbidden', compact('_setting'), 200)->header('Content-Type', 'text/html');
        }

        if (env('ADMIN')) {
            $forbidden_ips = explode("\n", $_setting->admin_forbidden_ip);
            $client_ip = $request->getClientIp();
            if (in_array($client_ip, $forbidden_ips))
                return response()->view('web.'.env('THEME').'.forbidden', compact('_setting'), 200)->header('Content-Type', 'text/html');
        }

        return $next($request);
    }
}
