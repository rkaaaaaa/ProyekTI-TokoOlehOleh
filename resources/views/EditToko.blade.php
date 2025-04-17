@extends('layouts.app')

@section('content')
<style>
    .form-control {
        border-radius: 20px;
        padding: 10px 15px;
    }

    .btn-custom {
        background-color: red;
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: bold;
        border: none;
    }

    .rounded-box {
        border: 2px solid #ccc;
        border-radius: 25px;
        padding: 20px;
        background-color: #fff;
    }
</style>

<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Edit Toko</h4>
    <div class="col-md-8 mx-auto">
        <div class="rounded-box">
            <form action="{{ route('toko.update', $toko->idToko) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Menampilkan error jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- ID User (Otomatis, Readonly) -->
                <div class="mb-3">
                    <label class="form-label">ID User</label>
                    <input type="text" class="form-control" value="{{ Auth::id() }}" readonly>
                    <input type="hidden" name="idUser" value="{{ Auth::id() }}">
                </div>

                <div class="mb-3">
                    <label for="namaToko" class="form-label">Nama Toko</label>
                    <input type="text" name="namaToko" class="form-control" value="{{ old('namaToko', $toko->namaToko) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamatToko" class="form-label">Alamat Toko</label>
                    <input type="text" name="alamatToko" class="form-control" value="{{ old('alamatToko', $toko->alamatToko) }}" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Update</button>
                    <a href="{{ route('toko.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
