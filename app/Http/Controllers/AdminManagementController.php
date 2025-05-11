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
        // Ambil semua admin (termasuk Superadmin dan Administrator)
        $admins = DB::table('ms_user')
            ->orderByRaw('idUser = 1 DESC') 
            ->orderByRaw('levelUser = "Superadmin" DESC') 
            ->orderBy('created_at', 'desc') 
            ->paginate(5);
        $jumlahSuperadmin = DB::table('ms_user')->where('levelUser', 'Superadmin')->count();

        return view('daftaradmin', compact('admins', 'jumlahSuperadmin'));
    }

    /**
     * Menampilkan form edit admin
     */
    public function edit($id)
    {
        $admin = DB::table('ms_user')->where('idUser', $id)->first();

        if (!$admin) {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        // Cek jika admin adalah Superadmin nonaktif
        if ($admin->levelUser === 'Superadmin' && $admin->statusUser === 'Nonaktif') {
            session()->flash('superadmin_nonaktif', 'Level Superadmin ini sudah dalam keadaan Nonaktif.');
        }

        return view('editdaftaradmin', compact('admin'));
    }

    /**
     * Update data admin
     */
    public function update(Request $request, $id)
    {
        $admin = DB::table('ms_user')->where('idUser', $id)->first();

        if (!$admin) {
            return redirect()->route('admin.index')->with('error', 'Admin tidak ditemukan');
        }

        $jumlahSuperadmin = DB::table('ms_user')->where('levelUser', 'Superadmin')->count();

        // Jika admin adalah Superadmin terakhir dan level diubah
        if ($admin->levelUser === 'Superadmin' && $jumlahSuperadmin === 1 && $request->levelUser !== 'Superadmin') {
            return redirect()->back()->with('error', 'Tidak dapat mengubah level Superadmin terakhir.');
        }

        // Jika ingin menaikkan ke Superadmin, pastikan belum ada Superadmin lain
        if ($request->levelUser === 'Superadmin' && $admin->levelUser !== 'Superadmin' && $jumlahSuperadmin >= 3) {
            return redirect()->back()->withInput()->withErrors([
                'levelUser' => 'Jumlah Superadmin tidak boleh lebih dari 3.',
            ]);
        }

        // Cegah pengeditan Superadmin dengan idUser = 1
        if ($admin->idUser === 1) {
            return redirect()->route('admin.index')
                ->with('error', 'Superadmin yang memiliki idUser = 1 tidak dapat diedit.');
        }

        // Validasi inputan
        $request->validate([
            'namaUser' => [
                'required',
                'max:15',
                Rule::unique('ms_user')->ignore($id, 'idUser'),
            ],
            'statusUser' => 'required|in:Aktif,Nonaktif',
            'levelUser' => 'required|in:Administrator,Superadmin',
        ]);

        $data = [
            'namaUser' => $request->namaUser,
            'statusUser' => $request->statusUser,
            'levelUser' => $request->levelUser,
            'updated_at' => now(),
        ];

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

        if (!$admin) {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        // Cegah perubahan status Superadmin dengan idUser = 1
        if ($admin->idUser === 1) {
            return redirect()->route('admin.index')
                ->with('error', 'Superadmin yang memiliki idUser = 1 tidak dapat diubah statusnya.');
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

        if (!$admin) {
            return redirect()->route('admin.index')
                ->with('error', 'Admin tidak ditemukan');
        }

        // Cegah penghapusan Superadmin dengan idUser = 1
        if ($admin->idUser === 1) {
            return redirect()->route('admin.index')
                ->with('error', 'Superadmin yang memiliki idUser = 1 tidak dapat dihapus.');
        }

        // Cegah penghapusan Superadmin terakhir
        if ($admin->levelUser === 'Superadmin') {
            $jumlahSuperadmin = DB::table('ms_user')->where('levelUser', 'Superadmin')->count();

            if ($jumlahSuperadmin <= 1) {
                return redirect()->route('admin.index')->with('error', 'Tidak dapat menghapus Superadmin terakhir.');
            }
        }

        DB::table('ms_user')->where('idUser', $id)->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}
