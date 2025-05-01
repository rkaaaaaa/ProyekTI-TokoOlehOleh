<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        // Tentukan waktu timeout dalam detik (misalnya, 1 menit = 60 detik)
        $timeout = 60; // Timeout dalam detik

        // Cek jika session last_activity ada
        if (Session::has('last_activity')) {
            $lastActivity = Session::get('last_activity');
            
            // Log waktu aktivitas terakhir
            Log::info('Last Activity: ' . date('Y-m-d H:i:s', $lastActivity));
        }

        // Periksa apakah sesi sudah lebih lama dari waktu timeout
        if (Session::has('last_activity') && (time() - Session::get('last_activity') > $timeout)) {
            // Jika sudah timeout, lakukan logout dan hapus sesi
            Log::info('Session expired. Logging out.');
            Auth::logout();
            Session::flush();
            return redirect('/login'); // Arahkan pengguna ke halaman login
        }

        // Perbarui waktu terakhir aktivitas
        Session::put('last_activity', time());

        return $next($request);
    }
}
