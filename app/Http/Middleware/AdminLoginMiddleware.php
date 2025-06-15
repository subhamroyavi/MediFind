<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!$request->session()->get('authenticated')) {
        //     return redirect()->route('admin.login');
        // }
        // return $next($request);
        if (Auth::check() && $request->session()->get('authenticated')) {
            return $next($request);
        }
        return Redirect()->route('admin.login-page');

    }
}
