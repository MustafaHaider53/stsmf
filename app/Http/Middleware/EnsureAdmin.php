<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('student')->check() && Auth::guard('student')->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect to login or show an error
        return redirect()->route('loginForm')->with('error', 'You do not have access to this page. Enter correct email and password .');
    }
}