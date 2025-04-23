<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna adalah user
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }

        // Jika tidak, redirect ke halaman utama atau error
        return redirect('/login')->with('error', 'You do not have user access.');
    }
}
