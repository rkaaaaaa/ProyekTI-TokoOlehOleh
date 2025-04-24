@extends('layouts.app')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Form Registrasi Admin Baru</h4>

    <form id="formRegistrasi" action="{{ route('register.store') }}" method="POST">
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

        <div class="mb-3">
            <label for="namaUser" class="form-label">Nama Admin</label>
            <input type="text" class="form-control" name="namaUser" maxlength="15" required value="{{ old('namaUser') }}">
        </div>

        <div class="mb-3">
            <label for="passwordUser" class="form-label">Password</label>
            <input type="password" class="form-control" name="passwordUser" minlength="6" required>
        </div>

        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-custom">Tambah Admin</button>
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
    // SweetAlert2 untuk konfirmasi submit
    document.getElementById('formRegistrasi').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Tambah Admin?',
            text: 'Apakah kamu yakin ingin menambahkan admin baru?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tambah!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit(); // Kirim form jika konfirmasi
            }
        });
    });
</script>

@endsection
