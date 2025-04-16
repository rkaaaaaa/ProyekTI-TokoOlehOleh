<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    private function cekAkses()
    {
        $user = Session::get('user');
        if (!$user || !in_array($user->levelUser, ['Superadmin', 'Administrator'])) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $this->cekAkses();
        $user = Session::get('user');
        $testimoni = Testimoni::where('idUser', $user->idUser)
            ->orderBy('tanggalTestimoni', 'desc')
            ->get();

        return view('testimoni', compact('testimoni'));
    }

    public function create()
    {
        $this->cekAkses();
        return view('tambahtestimoni');
    }

    public function store(Request $request)
    {
        $this->cekAkses();

        $request->validate([
            'gambarTestimoni' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggalTestimoni' => 'required|date'
        ]);

        $file = $request->file('gambarTestimoni');
        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/testimoni'), $filename);

        Testimoni::create([
            'idUser' => Session::get('user')->idUser,
            'gambarTestimoni' => $filename,
            'tanggalTestimoni' => $request->tanggalTestimoni
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $this->cekAkses();

        $testimoni = Testimoni::where('idTestimoni', $id)
            ->where('idUser', Session::get('user')->idUser)
            ->firstOrFail();

        return view('edittestimoni', compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        $this->cekAkses();

        $testimoni = Testimoni::where('idTestimoni', $id)
            ->where('idUser', Session::get('user')->idUser)
            ->firstOrFail();

        $filename = $testimoni->gambarTestimoni;

        if ($request->hasFile('gambarTestimoni')) {
            File::delete(public_path('uploads/testimoni/' . $filename));
            $file = $request->file('gambarTestimoni');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimoni'), $filename);
        }

        $testimoni->update([
            'gambarTestimoni' => $filename,
            'tanggalTestimoni' => $request->tanggalTestimoni ?? now()->toDateString()
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->cekAkses();

        $testimoni = Testimoni::findOrFail($id);

        if ($testimoni->gambarTestimoni && file_exists(public_path('uploads/testimoni/' . $testimoni->gambarTestimoni))) {
            unlink(public_path('uploads/testimoni/' . $testimoni->gambarTestimoni));
        }

        $testimoni->delete();

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
