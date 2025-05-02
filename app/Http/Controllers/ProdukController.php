<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Admin dashboard methods
    public function index()
    {
        $produk = Produk::orderBy('idProduk', 'desc')->paginate(5);
        return view('Produk', compact('produk'));
    }

    public function create()
    {
        return view('TambahProduk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaProduk'     => 'required|string|max:50',
            'hargaProduk'    => 'required|integer',
            'gambarProduk'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsiProduk'=> 'required|string',
            'kategoriProduk' => 'required|in:Sambel,Makanan',
            'varian'         => 'required_if:kategoriProduk,Sambel|in:Sedang,Pedas,Extra Pedas',
        ]);

        // Upload gambar
        $gambarPath = $request->file('gambarProduk')->store('produk', 'public');

        // Format deskripsi untuk sambel dengan menambahkan varian
        $deskripsi = $request->deskripsiProduk;
        if ($request->kategoriProduk == 'Sambel' && $request->varian) {
            if (!str_contains($deskripsi, 'Varian:')) {
                $deskripsi = "Varian: " . $request->varian . ". " . $deskripsi;
            }
        }

        Produk::create([
            'idUser'         => Auth::id(),
            'namaProduk'     => $request->namaProduk,
            'hargaProduk'    => $request->hargaProduk,
            'gambarProduk'   => $gambarPath,
            'deskripsiProduk'=> $deskripsi,
            'kategoriProduk' => $request->kategoriProduk,
            'varian'         => $request->varian,
        ]);

        return redirect()
            ->route('dashboard.produk')
            ->with('success', 'Produk berhasil ditambahkan');
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
            'namaProduk'     => 'required|string|max:50',
            'hargaProduk'    => 'required|integer',
            'gambarProduk'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsiProduk'=> 'required|string',
            'kategoriProduk' => 'required|in:Sambel,Makanan',
            'varian'         => 'required_if:kategoriProduk,Sambel|in:Sedang,Pedas,Extra Pedas',
        ]);

        if ($request->hasFile('gambarProduk')) {
            if ($produk->gambarProduk) {
                Storage::disk('public')->delete($produk->gambarProduk);
            }
            $produk->gambarProduk = $request->file('gambarProduk')->store('produk', 'public');
        }

        $deskripsi = $request->deskripsiProduk;
        if ($request->kategoriProduk == 'Sambel' && $request->varian) {
            if (preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $deskripsi)) {
                $deskripsi = preg_replace('/Varian:\s*(.*?)(?:\s*\.|$)/i', 'Varian: ' . $request->varian . '.', $deskripsi);
            } else {
                $deskripsi = "Varian: " . $request->varian . ". " . $deskripsi;
            }
        }

        $produk->update([
            'namaProduk'     => $request->namaProduk,
            'hargaProduk'    => $request->hargaProduk,
            'deskripsiProduk'=> $deskripsi,
            'kategoriProduk' => $request->kategoriProduk,
            'varian'         => $request->varian, 
        ]);

        return redirect()
            ->route('dashboard.produk')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambarProduk) {
            Storage::disk('public')->delete($produk->gambarProduk);
        }

        $produk->delete();

        return redirect()
            ->route('dashboard.produk')
            ->with('success', 'Produk berhasil dihapus');
    }

    // User-facing methods
    public function userIndex(Request $request)
    {
        $query = Produk::query();

        if ($request->has('kategori')) {
            $query->where('kategoriProduk', $request->kategori);
        }

        $query->orderBy('created_at', 'desc');

        $produk = $query->paginate(8)->withQueryString();

        return view('produk', compact('produk'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Produk::where('namaProduk', 'like', "%{$search}%")
                       ->orWhere('deskripsiProduk', 'like', "%{$search}%");

        $query->orderBy('created_at', 'desc');

        $produk = $query->paginate(8)->withQueryString();

        return view('produk', compact('produk'));
    }

    public function detail($id)
    {
        $produk = Produk::findOrFail($id);

        $related = Produk::where('kategoriProduk', $produk->kategoriProduk)
                         ->where('idProduk', '!=', $produk->idProduk)
                         ->limit(4)
                         ->get();

        return view('produk_detail', compact('produk', 'related'));
    }
}
