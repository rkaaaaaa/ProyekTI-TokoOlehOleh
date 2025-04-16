<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\MsUser;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::with('user')->get();
        return view('toko', compact('tokos'));
    }

    public function create()
    {
        $users = MsUser::all();
        return view('TambahToko', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaToko' => 'required',
            'alamatToko' => 'required',
            'idUser' => 'required|exists:ms_user,idUser',
        ]);

        Toko::create($request->all());
        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function show(Toko $toko)
    {
        return view('ShowToko', compact('toko'));
    }

    public function edit(Toko $toko)
    {
        $users = MsUser::all();
        return view('EditToko', compact('toko', 'users'));
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'namaToko' => 'required',
            'alamatToko' => 'required',
            'idUser' => 'required|exists:ms_user,idUser',
        ]);

        $toko->update($request->all());

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diupdate.');
    }

    public function destroy(Toko $toko)
    {
        $toko->delete();

        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
