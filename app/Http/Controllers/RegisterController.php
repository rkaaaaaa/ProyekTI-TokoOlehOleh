<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showForm()
    {
        if (!Auth::check() || Auth::user()->levelUser !== 'Superadmin') {
            return redirect()->route('dashboard')->withErrors(['error' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
        }

        return view('register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'namaUser' => 'required|unique:ms_user,namaUser',
            'passwordUser' => 'required|min:5',
            'levelUser' => 'required',
            'statusUser' => 'required'
        ]);

        DB::table('ms_user')->insert([
            'namaUser' => $request->namaUser,
            'passwordUser' => md5($request->passwordUser), // Simpan dalam MD5
            'levelUser' => $request->levelUser,
            'statusUser' => $request->statusUser
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
