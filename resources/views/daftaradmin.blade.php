@extends('layouts.app')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <h4 class="fw-bold mb-3">Daftar Admin</h4>

    <a href="{{ route('register.form') }}" class="btn btn-primary mb-3">Tambah Admin</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Admin</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $index => $admin)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $admin->namaUser }}</td>
                    <td>
                        <span class="badge bg-{{ $admin->statusUser === 'Aktif' ? 'success' : 'danger' }}">
                            {{ $admin->statusUser }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($admin->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>

                    <td>
                        <a href="{{ route('admin.edit', $admin->idUser) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.toggle-status', $admin->idUser) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $admin->statusUser === 'Aktif' ? 'secondary' : 'success' }} btn-sm" onclick="return confirm('Yakin ingin mengubah status admin ini?')">
                                {{ $admin->statusUser === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $admin->idUser }}">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada administrator yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    // SweetAlert2 untuk konfirmasi hapus
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const adminId = e.target.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Admin?',
                text: 'Apakah kamu yakin ingin menghapus admin ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form penghapusan
                    const form = document.createElement('form');
                    form.action = '/admin/' + adminId;
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
