<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('Produk', compact('produk'));
    }

    public function create()
    {
        return view('TambahProduk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaProduk' => 'required|string|max:50',
            'hargaProduk' => 'required|integer',
            'gambarProduk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsiProduk' => 'required|string',
            'kategoriProduk' => 'required|string'
        ]);

        $gambarPath = $request->file('gambarProduk')->store('produk', 'public');

        Produk::create([
            'idUser' => Auth::id(),
            'namaProduk' => $request->namaProduk,
            'hargaProduk' => $request->hargaProduk,
            'gambarProduk' => $gambarPath,
            'deskripsiProduk' => $request->deskripsiProduk,
            'kategoriProduk' => $request->kategoriProduk
        ]);

        return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('EditProduk', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'namaProduk' => 'required|string|max:50',
            'hargaProduk' => 'required|integer',
            'gambarProduk' => 'image|mimes:jpeg,png,jpg|max:2048',
            'deskripsiProduk' => 'required|string',
            'kategoriProduk' => 'required|string'
        ]);

        if ($request->hasFile('gambarProduk')) {
            if ($produk->gambarProduk) {
                Storage::disk('public')->delete($produk->gambarProduk);
            }
            $gambarPath = $request->file('gambarProduk')->store('produk', 'public');
            $produk->gambarProduk = $gambarPath;
        }

        $produk->update([
            'namaProduk' => $request->namaProduk,
            'hargaProduk' => $request->hargaProduk,
            'deskripsiProduk' => $request->deskripsiProduk,
            'kategoriProduk' => $request->kategoriProduk
        ]);

        return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambarProduk) {
            Storage::disk('public')->delete($produk->gambarProduk);
        }

        $produk->delete();

        return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil dihapus');
    }
}
