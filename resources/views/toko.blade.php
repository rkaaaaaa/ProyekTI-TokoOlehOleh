@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .rounded-box {
        border: 2px solid #ccc;
        border-radius: 25px;
        padding: 20px;
        background-color: #fff;
    }

    .btn-custom {
        border-radius: 12px;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .badge-status {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 12px;
    }
</style>

<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Data Toko</h4>

    <div class="rounded-box shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('toko.create') }}" class="btn btn-primary btn-custom">
                <i class="fas fa-plus-circle me-1"></i> Tambah Toko
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tokos as $toko)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $toko->namaToko }}</td>
                            <td>{{ $toko->alamatToko }}</td>
                            <td>
                                <a href="{{ route('toko.edit', $toko->idToko) }}" 
                                   class="btn btn-warning btn-sm btn-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn btn-danger btn-sm btn-custom delete-btn" 
                                        data-id="{{ $toko->idToko }}" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada data toko.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            const tokoId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Toko?',
                text: 'Apakah kamu yakin ingin menghapus toko ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.action = '/toko/' + tokoId;
                    form.method = 'POST';
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
