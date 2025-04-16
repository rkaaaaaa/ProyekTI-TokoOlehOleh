<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MsUser; // Menggunakan model MsUser
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }



    public function login(Request $request)
    {
        $request->validate([
            'namaUser' => 'required',
            'passwordUser' => 'required'
        ]);

    // Cek apakah user ada di database
    $user = MsUser::where('namaUser', $request->namaUser)
        ->where('passwordUser', md5($request->passwordUser)) // Password MD5
        ->first();
        
        if ($user) {
            // Set session user
            Auth::login($user); // Login menggunakan Auth
        
            // Setelah login, arahkan berdasarkan level user
            if ($user->levelUser === 'Superadmin') {
                return redirect()->route('dashboard');
            } elseif ($user->levelUser === 'Administrator') {
                return redirect()->route('dashboard.produk');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout

        $request->session()->invalidate(); // Menghapus session
        $request->session()->regenerateToken(); // Mengganti CSRF token

        return redirect()->route('login'); // Mengarahkan pengguna ke halaman login setelah logout
    }
}
