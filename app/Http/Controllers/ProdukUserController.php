<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukUserController extends Controller
{
    /**
     * Display a listing of the products for users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Produk::query();

        // Filter by category if provided
        if ($request->has('kategori')) {
            $query->where('kategoriProduk', $request->kategori);
        }

        $produk = $query->get();

        return view('produkuser.index', compact('produk'));
    }

    /**
     * Search for products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $produk = Produk::where('namaProduk', 'LIKE', "%{$search}%")
            ->orWhere('deskripsiProduk', 'LIKE', "%{$search}%")
            ->get();

        return view('produkuser.index', compact('produk'));
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $produk = Produk::findOrFail($id);

        // Get related products (same category, excluding current product)
        $related = Produk::where('kategoriProduk', $produk->kategoriProduk)
            ->where('idProduk', '!=', $produk->idProduk)
            ->limit(4)
            ->get();

        return view('produkuser.detail', compact('produk', 'related'));
    }
}
