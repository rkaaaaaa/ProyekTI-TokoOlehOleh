@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Tambah Toko</h4>

    <form action="{{ route('toko.store') }}" method="POST">
        @csrf

        <!-- Menampilkan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="namaToko">Nama Toko</label>
            <input type="text" name="namaToko" id="namaToko" class="form-control" required value="{{ old('namaToko') }}">
        </div>

        <div class="mb-3">
            <label for="alamatToko">Alamat Toko</label>
            <input type="text" name="alamatToko" id="alamatToko" class="form-control" required value="{{ old('alamatToko') }}">
        </div>

        <div class="mb-3">
            <label for="idUser">Pemilik (User)</label>
            <select name="idUser" id="idUser" class="form-control" required>
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                <option value="{{ $user->idUser }}">{{ $user->namaUser }}</option>
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success" type="submit">Simpan</button>
        <a href="{{ route('toko.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
