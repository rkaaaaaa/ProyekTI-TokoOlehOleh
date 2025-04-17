@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Tambah Toko</h4>

    <form action="{{ route('toko.store') }}" method="POST">
        @csrf

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ID User otomatis --}}
        <div class="mb-3">
            <label class="form-label">ID User</label>
            <input type="text" class="form-control" value="{{ Auth::id() }}" readonly>
            <input type="hidden" name="idUser" value="{{ Auth::id() }}">
        </div>

        <div class="mb-3">
            <label for="namaToko" class="form-label">Nama Toko</label>
            <input type="text" name="namaToko" id="namaToko" class="form-control" required value="{{ old('namaToko') }}">
        </div>

        <div class="mb-3">
            <label for="alamatToko" class="form-label">Alamat Toko</label>
            <input type="text" name="alamatToko" id="alamatToko" class="form-control" required value="{{ old('alamatToko') }}">
        </div>

        <button class="btn btn-custom" type="submit">Simpan</button>
        <a href="{{ route('toko.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<style>
    .btn-custom {
        background-color: red;
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: bold;
        border: none;
    }
</style>
@endsection
