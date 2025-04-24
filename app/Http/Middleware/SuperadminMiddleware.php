<?php

// app/Http/Middleware/SuperAdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki level 'Superadmin'
        if (Auth::check() && Auth::user()->levelUser === 'Superadmin') {
            return $next($request);
        }

        // Redirect jika tidak memiliki izin
        return redirect()->route('dashboard')->withErrors(['error' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
    }
}
