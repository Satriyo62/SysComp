<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session admin ada
        if (!session()->has('is_admin')) {
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}