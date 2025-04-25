<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function create()
    {
        return view('register'); // arahkan ke form registrasi admin
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaUser' => 'required|unique:ms_user,namaUser|max:15',
            'passwordUser' => 'required|min:6'
        ]);

        DB::table('ms_user')->insert([
            'namaUser' => $request->namaUser,
            'passwordUser' => md5($request->passwordUser), // disesuaikan dengan field `passwordUser` (32 char md5)
            'levelUser' => 'Administrator', // default
            'statusUser' => $request->statusUser,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.index')->with('success', 'Administrator berhasil ditambahkan.');
    }
}
