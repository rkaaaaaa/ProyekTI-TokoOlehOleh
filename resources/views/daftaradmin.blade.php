@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/texture-whites.png') }}');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            opacity: 0.1; 
            z-index: -1; 
        }

        .rounded-box {
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            background-color: #fff;
        }

        .btn-custom {
            border-radius: 12px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 12px;
        }

        .form-control {
            border-radius: 20px;
            padding: 10px 15px;
        }

        .btn-save {
            background: red;
            color: #fff;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: bold;
            border: none;
        }
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Daftar Admin</h4>

        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-custom" style="background-color: red; color: white;" data-bs-toggle="modal"
                    data-bs-target="#modalTambahAdmin">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Admin
                </button>


            </div>

            @if (session('success'))
                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: '{{ session('success') }}',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                </script>
            @endif

            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: @if ($errors->has('namaUser'))
                                'Username sudah digunakan.'
                            @elseif ($errors->has('passwordUser'))
                                'Password minimal 6 karakter.'
                            @else
                                'Terjadi kesalahan, coba lagi.'
                            @endif ,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
                </script>
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
                                    <span
                                        class="badge badge-status bg-{{ $admin->statusUser === 'Aktif' ? 'success' : 'danger' }}">
                                        {{ $admin->statusUser }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($admin->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-custom edit-btn"
                                        data-id="{{ $admin->idUser }}" data-nama="{{ $admin->namaUser }}"
                                        data-status="{{ $admin->statusUser }}" data-password="" data-bs-toggle="modal"
                                        data-bs-target="#modalEditAdmin" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>

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
                                            data-id="{{ $admin->idUser }}" data-status="{{ $admin->statusUser }}"
                                            title="Ubah Status">
                                            <i
                                                class="fas {{ $admin->statusUser === 'Aktif' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
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

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Tambah Admin</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('register.store') }}" method="POST" onsubmit="return confirmSave(event,'Tambah')">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Admin</label>
                            <input type="text" name="namaUser" class="form-control" required
                                value="{{ old('namaUser') }}">
                        </div>
                        <div class="mb-3">
                            <label for="passwordUser" class="form-label">Password</label>
                            <input type="password" name="passwordUser" class="form-control" required
                                value="{{ old('passwordUser') }}">
                        </div>
                        <div class="mb-3">
                            <label for="statusUser" class="form-label">Status</label>
                            <select name="statusUser" class="form-control" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-save w-100"><i class="fas fa-save me-1"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Admin -->
    <div class="modal fade" id="modalEditAdmin" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Edit Admin</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.update', ':id') }}" method="POST" id="editAdminForm"
                    onsubmit="return confirmSave(event,'Edit')">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Admin</label>
                            <input type="text" name="namaUser" class="form-control" required id="editNamaUser">
                        </div>
                        <div class="mb-3">
                            <label for="statusUser" class="form-label">Status</label>
                            <select name="statusUser" class="form-control" required id="editStatusUser">
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="passwordUser" class="form-label">Password Baru</label>
                            <input type="password" name="passwordUser" class="form-control" id="editPasswordUser">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti password.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-save w-100"><i class="fas fa-save me-1"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Script Hapus Admin -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const adminId = this.dataset.id;
                Swal.fire({
                    title: 'Hapus Admin?',
                    text: 'Apakah kamu yakin ingin menghapus admin ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa'
                }).then(result => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.action = `/admin/${adminId}`;
                        form.method = 'POST';
                        form.innerHTML = '@csrf @method('DELETE')';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // Script Toggle Status
        document.querySelectorAll('.toggle-status-btn').forEach(button => {
            button.addEventListener('click', function() {
                const adminId = this.dataset.id;
                const currentStatus = this.dataset.status;
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
                }).then(result => {
                    if (result.isConfirmed) {
                        document.getElementById('toggle-status-form-' + adminId).submit();
                    }
                });
            });
        });

        //<!-- Script Edit Admin -->
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const adminId = this.dataset.id;
                const nama = this.dataset.nama;
                const status = this.dataset.status;

                // Set form action URL dinamis berdasarkan ID
                const form = document.getElementById('editAdminForm');
                form.action = `/admin/${adminId}`;

                // Isi input form dengan data dari button
                document.getElementById('editNamaUser').value = nama;
                document.getElementById('editStatusUser').value = status;
                document.getElementById('editPasswordUser').value = '';
            });
        });

        // Script Konfirmasi Simpan
        function confirmSave(event, mode) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Yakin ingin menyimpan data?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#198754',
                cancelButtonColor: '#aaa'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
            return false;
        }
    </script>
@endsection
