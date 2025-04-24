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
        $adminCount = Msuser::where('levelUser', 'Administrator')->count();
        $tokoCount = Toko::count();
        $produkCount = Produk::count();
        $testimoniCount = Testimoni::count();

        return view('dashboard', compact('adminCount', 'tokoCount', 'produkCount', 'testimoniCount'));
    }
}
