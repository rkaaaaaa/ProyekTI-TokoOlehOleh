<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user yang sedang login adalah Superadmin
        if (Auth::check() && Auth::user()->levelUser === 'Superadmin') {
            return $next($request);  // Lanjutkan permintaan jika Superadmin
        }

        // Jika bukan Superadmin, alihkan ke dashboard atau halaman lain
        return redirect()->route('dashboard')->withErrors(['error' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
    }
}
