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
        <h4 class="fw-bold text-danger mb-4">Daftar Admin</h4>

        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('register.form') }}" class="btn btn-primary btn-custom">
                    <i class="fas fa-user-plus me-1"></i> Tambah Admin
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
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
                                    <span class="badge badge-status bg-{{ $admin->statusUser === 'Aktif' ? 'success' : 'danger' }}">
                                        {{ $admin->statusUser }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($admin->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.edit', $admin->idUser) }}"
                                       class="btn btn-warning btn-sm btn-custom" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm btn-custom delete-btn"
                                            data-id="{{ $admin->idUser }}" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <form id="toggle-status-form-{{ $admin->idUser }}"
                                          action="{{ route('admin.toggle-status', $admin->idUser) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button"
                                                class="btn btn-sm btn-custom toggle-status-btn {{ $admin->statusUser === 'Aktif' ? 'btn-success' : 'btn-secondary' }}"
                                                data-id="{{ $admin->idUser }}"
                                                data-status="{{ $admin->statusUser }}"
                                                title="Ubah Status">
                                            <i class="fas {{ $admin->statusUser === 'Aktif' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
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
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                const adminId = this.getAttribute('data-id');
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

        document.querySelectorAll('.toggle-status-btn').forEach(button => {
            button.addEventListener('click', function () {
                const adminId = this.getAttribute('data-id');
                const currentStatus = this.getAttribute('data-status');
                const newStatus = currentStatus === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan';

                Swal.fire({
                    title: 'Ubah Status Admin?',
                    text: `Apakah kamu yakin ingin ${newStatus.toLowerCase()} admin ini?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: `Ya, ${newStatus}`,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#aaa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('toggle-status-form-' + adminId).submit();
                    }
                });
            });
        });
    </script>
@endsection
