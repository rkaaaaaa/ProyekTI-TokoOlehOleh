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
    <h4 class="fw-bold text-danger mb-4">Data Testimoni</h4>

    <div class="rounded-box shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('testimoni.create') }}" class="btn btn-primary btn-custom">
                <i class="fas fa-plus-circle me-1"></i> Tambah Testimoni
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
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimoni as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->gambarTestimoni) }}" 
                                     alt="Testimoni Gambar" style="max-width: 100px; border-radius: 6px;">
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggalTestimoni)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('testimoni.edit', $item->idTestimoni) }}" 
                                   class="btn btn-warning btn-sm btn-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn btn-danger btn-sm btn-custom delete-btn" 
                                        data-id="{{ $item->idTestimoni }}" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada data testimoni.</td>
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
            const testimoniId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Testimoni?',
                text: 'Apakah kamu yakin ingin menghapus testimoni ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.action = '/testimoni/' + testimoniId;
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
