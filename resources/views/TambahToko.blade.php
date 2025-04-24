@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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

        <button type="submit" class="btn btn-custom" onclick="return confirmSimpan(event)">Simpan</button>
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

<script>
    function confirmSimpan(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Simpan Testimoni',
            text: 'Apakah kamu yakin ingin menyimpan testimonni?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.closest('form').submit();
            }
        });
    }
</script>
@endsection
