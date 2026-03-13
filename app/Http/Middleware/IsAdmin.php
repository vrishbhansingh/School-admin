<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and is admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Agar admin nahi hai, toh admin login page pe bhejo
        return redirect()->route('admin.login');
    }
}
