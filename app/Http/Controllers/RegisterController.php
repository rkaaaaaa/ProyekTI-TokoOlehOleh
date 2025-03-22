<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register'); // Menampilkan halaman register
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
