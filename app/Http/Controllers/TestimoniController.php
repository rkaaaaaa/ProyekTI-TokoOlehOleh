<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::all();
        return view('testimoni', compact('testimoni'));
    }

    public function create()
    {
        return view('tambahtestimoni');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idUser' => 'required|integer',
            'gambarTestimoni' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggalTestimoni' => 'required|date'
        ]);

        $gambarPath = $request->file('gambarTestimoni')->store('testimoni', 'public');

        Testimoni::create([
            'idUser' => $request->idUser,
            'gambarTestimoni' => $gambarPath,
            'tanggalTestimoni' => $request->tanggalTestimoni
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        return view('edittestimoni', compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);

        $request->validate([
            'gambarTestimoni' => 'image|mimes:jpeg,png,jpg|max:2048',
            'tanggalTestimoni' => 'required|date'
        ]);

        if ($request->hasFile('gambarTestimoni')) {
            if ($testimoni->gambarTestimoni) {
                Storage::disk('public')->delete($testimoni->gambarTestimoni);
            }
            $gambarPath = $request->file('gambarTestimoni')->store('testimoni', 'public');
            $testimoni->gambarTestimoni = $gambarPath;
        }

        $testimoni->update([
            'tanggalTestimoni' => $request->tanggalTestimoni
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diperbarui');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        if ($testimoni->gambarTestimoni) {
            Storage::disk('public')->delete($testimoni->gambarTestimoni);
        }

        $testimoni->delete();

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus');
    }
}