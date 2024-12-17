<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::guard('admin')->check()) {
            $response = $next($request);
            return $response->header('Access-Control-Allow-Origin', '*');
        } else {
                return redirect()->route('login');
        }
        if (Auth::guard('web')->check()) {
            $response = $next($request);
            return $response->header('Access-Control-Allow-Origin', '*');
        } else {
                return redirect()->route('login');
        }
    }

    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (Auth::guard('admin')->check()) {
    //         $response = $next($request);
    //         return $response->header('Access-Control-Allow-Origin', '*');
    //     }

    //     if (Auth::guard('web')->check()) {
    //         $response = $next($request);
    //         return $response->header('Access-Control-Allow-Origin', '*');
    //     }

    //     return redirect()->route('login');
    // }
}
