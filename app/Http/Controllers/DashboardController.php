<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsUser;
use App\Models\Toko;
use App\Models\Produk;
use App\Models\Testimoni;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil pesan error jika ada
        $errorMessage = session('error');

        $adminCount = MsUser::where('levelUser', 'Administrator')->count();
        $tokoCount = Toko::count();
        $produkCount = Produk::count();
        $testimoniCount = Testimoni::count();

        // Ambil 10 produk terbaru
        $produk = Produk::orderBy('idProduk', 'desc')->take(3)->get();

        return view('dashboard', compact(
            'adminCount',
            'tokoCount',
            'produkCount',
            'testimoniCount',
            'produk',
            'errorMessage' // Menambahkan pesan error ke view
        ));
    }
}
