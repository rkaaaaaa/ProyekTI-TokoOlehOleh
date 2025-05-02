<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    /**
     * Menampilkan daftar admin
     */
    public function index()
    {
        // Ambil semua admin (level Administrator)
        $admins = DB::table('ms_user')
            ->where('levelUser', 'Administrator')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('daftaradmin', compact('admins'));
    }

    /**
     * Menampilkan form edit admin
     */
    public function edit($id)
    {
        $admin = DB::table('ms_user')->where('idUser', $id)->first();
        
        if (!$admin || $admin->levelUser !== 'Administrator') {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        return view('editdaftaradmin', compact('admin'));
    }

    /**
     * Update data admin
     */
    public function update(Request $request, $id)
    {
        $admin = DB::table('ms_user')->where('idUser', $id)->first();
        
        if (!$admin || $admin->levelUser !== 'Administrator') {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        $request->validate([
            'namaUser' => [
                'required',
                'max:15',
                Rule::unique('ms_user')->ignore($id, 'idUser'),
            ],
            'statusUser' => 'required|in:Aktif,Nonaktif',
        ]);

        $data = [
            'namaUser' => $request->namaUser,
            'statusUser' => $request->statusUser,
            'updated_at' => now(),
        ];

        // Jika password diisi, update password
        if ($request->filled('passwordUser')) {
            $request->validate([
                'passwordUser' => 'min:6',
            ]);
            $data['passwordUser'] = md5($request->passwordUser);
        }

        DB::table('ms_user')
            ->where('idUser', $id)
            ->update($data);

        return redirect()->route('admin.index')
            ->with('success', 'Data admin berhasil diperbarui');
    }

    /**
     * Mengubah status admin (Aktif/Nonaktif)
     */
    public function toggleStatus($id)
    {
        $admin = DB::table('ms_user')->where('idUser', $id)->first();
        
        if (!$admin || $admin->levelUser !== 'Administrator') {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        $newStatus = $admin->statusUser === 'Aktif' ? 'Nonaktif' : 'Aktif';

        DB::table('ms_user')
            ->where('idUser', $id)
            ->update([
                'statusUser' => $newStatus,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.index')
            ->with('success', "Status admin berhasil diubah menjadi $newStatus");
    }

    /**
     * Menghapus admin
     */
    public function destroy($id)
    {
        $admin = DB::table('ms_user')->where('idUser', $id)->first();
        
        if (!$admin || $admin->levelUser !== 'Administrator') {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        DB::table('ms_user')->where('idUser', $id)->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}