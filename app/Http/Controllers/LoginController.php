<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MsUser; // Menggunakan model MsUser

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Menampilkan halaman login
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
            Session::put('user', $user);
            
            // Debugging: Periksa apakah session user ada
            if(Session::has('user')) {
                // Jika berhasil menyimpan session, redirect ke halaman dashboard
                if ($user->levelUser === 'Superadmin') {
                    return redirect()->route('dashboard');
                } elseif ($user->levelUser === 'Administrator') {
                    return redirect()->route('dashboard.produk');
                }
            } else {
                return redirect()->back()->with('error', 'Terjadi masalah dengan session!');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
    }

    public function logout()
    {
        Session::forget('user'); // Hapus session user
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
