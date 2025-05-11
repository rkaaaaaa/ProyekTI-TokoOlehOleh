<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function create()
    {
        // Hitung jumlah superadmin, kirim ke view
        $jumlahSuperadmin = DB::table('ms_user')->where('levelUser', 'Superadmin')->count();
        return view('register', compact('jumlahSuperadmin'));
    }

    public function store(Request $request)
    {
        $jumlahSuperadmin = DB::table('ms_user')->where('levelUser', 'Superadmin')->count();

        $request->validate([
            'namaUser' => 'required|unique:ms_user,namaUser|max:15',
            'passwordUser' => 'required|min:6',
            'statusUser' => 'required|in:Aktif,Nonaktif',
            'levelUser' => 'required|in:Administrator,Superadmin',
        ]);

        // Cegah pembuatan Superadmin jika sudah 3
        if ($request->levelUser === 'Superadmin' && $jumlahSuperadmin >= 3) {
            return redirect()->back()
                ->with('error', 'Maksimal hanya 3 akun Superadmin yang diizinkan.')
                ->withInput();
        }

        DB::table('ms_user')->insert([
            'namaUser' => $request->namaUser,
            'passwordUser' => md5($request->passwordUser),
            'levelUser' => $request->levelUser,
            'statusUser' => $request->statusUser,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('admin.index')->with('success', ucfirst($request->levelUser) . ' berhasil ditambahkan.');
    }
}
