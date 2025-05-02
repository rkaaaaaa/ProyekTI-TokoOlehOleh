<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\MsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::with('user')->paginate(5);
        return view('toko', compact('tokos'));
    }
    
    public function indexUsers()
    {
        $tokos = Toko::all();
        return view('userlokasi', compact('tokos'));
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
    ]);

    Toko::create([
        'idUser' => Auth::id(),
        'namaToko' => $request->namaToko,
        'alamatToko' => $request->alamatToko,
    ]);

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

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diubah.');
    }

    public function destroy(Toko $toko)
    {
        $toko->delete();

        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
