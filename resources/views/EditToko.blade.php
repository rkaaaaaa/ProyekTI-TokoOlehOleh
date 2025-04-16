@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Toko</h4>

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

    <form action="{{ route('toko.update', $toko->idToko) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="namaToko">Nama Toko</label>
            <input type="text" name="namaToko" id="namaToko" class="form-control" value="{{ old('namaToko', $toko->namaToko) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamatToko">Alamat Toko</label>
            <input type="text" name="alamatToko" id="alamatToko" class="form-control" value="{{ old('alamatToko', $toko->alamatToko) }}" required>
        </div>

        <div class="mb-3">
            <label for="idUser">Pemilik (User)</label>
            <select name="idUser" id="idUser" class="form-control" required>
                <option value="" disabled {{ old('idUser', $toko->idUser) ? '' : 'selected' }}>-- Pilih User --</option>
                @foreach ($users as $user)
                <option value="{{ $user->idUser }}" {{ old('idUser', $toko->idUser) == $user->idUser ? 'selected' : '' }}>
                        {{ $user->namaUser }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('toko.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
