@extends('layouts.app')

@section('content')

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

<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Edit Admin</h4>

    <form action="{{ route('admin.update', $admin->idUser) }}" method="POST">
        @csrf
        @method('PUT')

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

        <div class="mb-3">
            <label for="namaUser" class="form-label">Nama Admin</label>
            <input type="text" name="namaUser" id="namaUser" class="form-control" 
                   required maxlength="15" value="{{ old('namaUser', $admin->namaUser) }}">
        </div>

        <div class="mb-3">
            <label for="statusUser" class="form-label">Status</label>
            <select name="statusUser" id="statusUser" class="form-select" required>
                <option value="Aktif" {{ old('statusUser', $admin->statusUser) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ old('statusUser', $admin->statusUser) === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="passwordUser" class="form-label">Password Baru </label>
            <input type="password" name="passwordUser" id="passwordUser" class="form-control">
            <div class="form-text">Kosongkan jika tidak ingin mengganti password.</div>
        </div>

        <button class="btn btn-custom" type="submit">Simpan</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
