@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

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

        table td img {
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        table tbody tr {
            height: 80px;
            vertical-align: middle;
        }

        .admin-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .admin-badge i {
            font-size: 0.75rem;
        }

        /* Badge untuk level */
        .admin-badge.superadmin {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .admin-badge.administrator {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        /* Badge untuk status */
        .admin-badge.active {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .admin-badge.inactive {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        /* Styling untuk tanggal */
        .date-cell {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .date-cell i {
            margin-right: 5px;
        }

        /* Styling untuk tombol aksi */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border: none;
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btn.edit {
            background-color: #ffc107;
        }

        .action-btn.delete {
            background-color: #dc3545;
        }

        .action-btn.toggle-active {
            background-color: #198754;
        }

        .action-btn.toggle-inactive {
            background-color: #6c757d;
        }

        /* Styling untuk header tabel dan tombol tambah */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-admin-btn {
            background: linear-gradient(135deg, #ff3333, #cc0000);
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(234, 7, 7, 0.2);
        }

        .add-admin-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(234, 7, 7, 0.3);
        }

        /* Styling untuk pagination */
        .pagination {
            margin-top: 20px;
        }

        .pagination .page-item .page-link {
            border-radius: 50%;
            margin: 0 3px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            border: none;
            transition: all 0.2s;
        }

        .pagination .page-item.active .page-link {
            background-color: #ea0707;
            color: white;
            box-shadow: 0 4px 8px rgba(234, 7, 7, 0.2);
        }

        .pagination .page-item .page-link:hover:not(.active) {
            background-color: rgba(234, 7, 7, 0.1);
            color: #ea0707;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
        }

        .pagination-nav {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .pagination-info strong {
            color: #ea0707;
            font-weight: 600;
        }

        .disabled-btn {
            cursor: not-allowed !important;
            opacity: 0.6 !important;
            pointer-events: auto !important;
        }
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Daftar Admin</h4>

        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-custom" style="background-color: #ea0707; color: white;" data-bs-toggle="modal"
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

            @if ($errors->has('superadmin'))
                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: 'Superadmin utama tidak dapat diubah atau dihapus.',
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
                            <th>Level</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $index => $admin)
                            <tr>
                                <td>{{ $admins->firstItem() + $index }}</td>
                                <td>{{ $admin->namaUser }}</td>
                                <td>
                                    <span
                                        class="admin-badge {{ $admin->levelUser === 'Superadmin' ? 'superadmin' : 'administrator' }}">
                                        <i
                                            class="fas {{ $admin->levelUser === 'Superadmin' ? 'fa-user-shield' : 'fa-user' }}"></i>
                                        {{ $admin->levelUser }}
                                    </span>
                                </td>
                                <td>
                                    <span class="admin-badge {{ $admin->statusUser === 'Aktif' ? 'active' : 'inactive' }}">
                                        <i
                                            class="fas {{ $admin->statusUser === 'Aktif' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                        {{ $admin->statusUser }}
                                    </span>
                                </td>
                                <td class="date-cell">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($admin->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                </td>
                                <td>
                                    @if ($admin->idUser === 1)
                                        <!-- Tombol untuk Superadmin Utama (ID 1) -->
                                        <button type="button" class="btn btn-warning btn-sm btn-custom disabled-btn"
                                            onclick="showSuperadminWarning()" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm btn-custom disabled-btn"
                                            onclick="showSuperadminWarning()" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <button type="button"
                                            class="btn btn-sm btn-custom disabled-btn {{ $admin->statusUser === 'Aktif' ? 'btn-success' : 'btn-secondary' }}"
                                            onclick="showSuperadminWarning()" title="Ubah Status">
                                            <i
                                                class="fas {{ $admin->statusUser === 'Aktif' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    @else
                                        <!-- Tombol untuk Admin Biasa -->
                                        <button class="btn btn-warning btn-sm btn-custom edit-btn"
                                            data-id="{{ $admin->idUser }}" data-nama="{{ $admin->namaUser }}"
                                            data-status="{{ $admin->statusUser }}" data-password=""
                                            data-level="{{ $admin->levelUser }}" data-bs-toggle="modal"
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
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada administrator yang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <!-- Pagination -->
                <div class="pagination-nav mt-3">
                    <p class="pagination-info mb-0">
                        Menampilkan <strong>{{ $admins->firstItem() }}</strong> hingga
                        <strong>{{ $admins->lastItem() }}</strong> dari total <strong>{{ $admins->total() }}</strong>
                        admin
                    </p>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item {{ $admins->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $admins->previousPageUrl() }}" aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>

                            @for ($i = 1; $i <= $admins->lastPage(); $i++)
                                <li class="page-item {{ $admins->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $admins->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item {{ !$admins->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $admins->nextPageUrl() }}" aria-label="Next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold text-danger fs-4">Tambah Admin</h5>
                    <button class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-4">
                        <div class="mb-4">
                            <label class="form-label fw-medium">Nama Admin</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-user text-danger"></i>
                                </span>
                                <input type="text" name="namaUser" class="form-control border-start-0 ps-2" required
                                    value="{{ old('namaUser') }}" placeholder="Masukkan nama admin">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="passwordUser" class="form-label fw-medium">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-lock text-danger"></i>
                                </span>
                                <input type="password" name="passwordUser" id="passwordUser"
                                    class="form-control border-start-0 border-end-0 ps-2" required
                                    value="{{ old('passwordUser') }}" placeholder="Masukkan password">
                                <button class="input-group-text bg-light border-start-0 toggle-password" type="button"
                                    data-target="passwordUser" style="width: 45px; justify-content: center;">
                                    <i class="fas fa-eye text-secondary"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="levelUser" class="form-label fw-medium">Level</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-user-shield text-danger"></i>
                                </span>
                                <select name="levelUser" id="levelUser" class="form-control border-start-0 ps-2"
                                    required>
                                    <option value="Administrator"
                                        {{ old('levelUser') == 'Administrator' ? 'selected' : '' }}>
                                        Administrator</option>
                                    <option value="Superadmin" {{ old('levelUser') == 'Superadmin' ? 'selected' : '' }}>
                                        Superadmin
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="statusUser" class="form-label fw-medium">Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-toggle-on text-danger"></i>
                                </span>
                                <select name="statusUser" class="form-control border-start-0 ps-2" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn-save w-100 py-3 d-flex align-items-center justify-content-center gap-2" id="btnSave">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Admin -->
    <input type="hidden" id="initialLevel" name="initialLevel" value="">
    <div class="modal fade" id="modalEditAdmin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold text-danger fs-4">Edit Admin</h5>
                    <button class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.update', ':id') }}" method="POST" id="editAdminForm"
                    onsubmit="return confirmSave(event,'Edit')">
                    @csrf
                    @method('PUT')
                    <div class="modal-body py-4">
                        <div class="mb-4">
                            <label class="form-label fw-medium">Nama Admin</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-user text-danger"></i>
                                </span>
                                <input type="text" name="namaUser" class="form-control border-start-0 ps-2" required
                                    id="editNamaUser">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="passwordUser" class="form-label fw-medium">Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-lock text-danger"></i>
                                </span>
                                <input type="password" name="passwordUser" id="editPasswordUser"
                                    class="form-control border-start-0 border-end-0 ps-2"
                                    placeholder="Kosongkan jika tidak ingin mengganti password">
                                <button class="input-group-text bg-light border-start-0 toggle-password" type="button"
                                    data-target="editPasswordUser" style="width: 45px; justify-content: center;">
                                    <i class="fas fa-eye text-secondary"></i>
                                </button>
                            </div>
                            <div class="form-text text-muted fst-italic mt-1">
                                <i class="fas fa-info-circle me-1"></i>Kosongkan jika tidak ingin mengganti password.
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="editLevelUser" class="form-label fw-medium">Level</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-user-shield text-danger"></i>
                                </span>
                                <select name="levelUser" class="form-control border-start-0 ps-2" id="editLevelUser">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Superadmin">Superadmin</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="statusUser" class="form-label fw-medium">Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="width: 45px; justify-content: center;">
                                    <i class="fas fa-toggle-on text-danger"></i>
                                </span>
                                <select name="statusUser" class="form-control border-start-0 ps-2" required
                                    id="editStatusUser">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn-save w-100 py-3 d-flex align-items-center justify-content-center gap-2"
                        id="btnEditSave">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

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
                const level = this.dataset.level;

                // Set form action URL dinamis berdasarkan ID
                const form = document.getElementById('editAdminForm');
                form.action = `/admin/${adminId}`;

                // Isi input form dengan data dari button
                document.getElementById('editNamaUser').value = nama;
                document.getElementById('editStatusUser').value = status;
                document.getElementById('editLevelUser').value = level;
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
                confirmButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
            return false;
        }
        // <-- ! Tambahkan Script untuk Menonaktifkan Tombol Simpan di Modal Tambah Admin -->
        document.addEventListener('DOMContentLoaded', function() {
            const levelSelect = document.getElementById('levelUser');
            const saveButton = document.getElementById('btnSave');

            // Fungsi untuk periksa batas superadmin
            function checkSuperadminLimit() {
                if (levelSelect.value === 'Superadmin' && {{ $jumlahSuperadmin }} >= 3) {
                    saveButton.disabled = true;
                    saveButton.style.backgroundColor = '#ccc';
                    saveButton.style.cursor = 'not-allowed';
                    saveButton.style.color = '#777';
                    saveButton.style.opacity = '0.5';

                    // Tampilkan notifikasi hanya jika superadmin penuh
                    Swal.fire({
                        icon: 'warning',
                        title: 'Batas Superadmin Tercapai',
                        text: 'Tidak dapat menambah Superadmin. Batas maksimal 3 Superadmin.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                } else {
                    saveButton.disabled = false;
                    saveButton.style.backgroundColor = '#ea0707';
                    saveButton.style.cursor = 'pointer';
                    saveButton.style.color = 'white';
                    saveButton.style.opacity = '1';
                }
            }

            checkSuperadminLimit();

            // Periksa saat dropdown level diubah
            levelSelect.addEventListener('change', checkSuperadminLimit);
        });

        // <-- ! Tambahkan Script untuk Menonaktifkan Tombol Simpan di Modal Edit Admin -->
        document.addEventListener('DOMContentLoaded', function() {
            const editLevelSelect = document.getElementById('editLevelUser');
            const editSaveButton = document.getElementById('btnEditSave');
            const initialLevelInput = document.getElementById('initialLevel');

            function checkEditSuperadminLimit() {
                const currentLevel = initialLevelInput.value;
                const selectedLevel = editLevelSelect.value;
                const maxSuperadminsReached = {{ $jumlahSuperadmin }} >= 3;

                // Jika mengubah ke superadmin tapi sudah penuh
                if (selectedLevel === 'Superadmin' && currentLevel !== 'Superadmin' && maxSuperadminsReached) {
                    editSaveButton.disabled = true;
                    editSaveButton.style.backgroundColor = '#ccc';
                    editSaveButton.style.cursor = 'not-allowed';
                    editSaveButton.style.color = '#777';
                    editSaveButton.style.opacity = '0.5';

                    // Tampilkan notifikasi hanya jika superadmin penuh
                    Swal.fire({
                        icon: 'warning',
                        title: 'Batas Superadmin Tercapai',
                        text: 'Tidak dapat mengubah menjadi Superadmin. Batas maksimal 3 Superadmin.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                } else {
                    // Aktifkan kembali tombol simpan
                    editSaveButton.disabled = false;
                    editSaveButton.style.backgroundColor = '#ea0707';
                    editSaveButton.style.cursor = 'pointer';
                    editSaveButton.style.color = 'white';
                    editSaveButton.style.opacity = '1';
                }
            }

            // Periksa saat modal dibuka
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil level awal dari atribut data-level
                    const initialLevel = this.getAttribute('data-level');
                    initialLevelInput.value = initialLevel;

                    // Tunggu sedikit sebelum mengecek
                    setTimeout(() => {
                        checkEditSuperadminLimit();
                    }, 100);
                });
            });

            // Periksa saat dropdown level diubah
            editLevelSelect.addEventListener('change', checkEditSuperadminLimit);
        });

        // Script untuk reset level ke 'Administrator' saat modal ditutup
        document.addEventListener('DOMContentLoaded', function() {
            const levelSelect = document.getElementById('levelUser');
            const editLevelSelect = document.getElementById('editLevelUser');
            const saveButton = document.getElementById('btnSave');
            const editSaveButton = document.getElementById('btnEditSave');
            const modals = ['#modalTambahAdmin', '#modalEditAdmin'];

            // Atur level ke 'Administrator' saat modal ditutup
            modals.forEach(modalId => {
                const modalElement = document.querySelector(modalId);
                if (modalElement) {
                    modalElement.addEventListener('hidden.bs.modal', function() {
                        if (modalId === '#modalTambahAdmin' && levelSelect) {
                            levelSelect.value = 'Administrator';
                            saveButton.disabled = false;
                            saveButton.style.backgroundColor = '#ea0707';
                            saveButton.style.cursor = 'pointer';
                            saveButton.style.color = 'white';
                            saveButton.style.opacity = '1';
                        }
                        if (modalId === '#modalEditAdmin' && editLevelSelect) {
                            editLevelSelect.value = 'Administrator';
                            editSaveButton.disabled = false;
                            editSaveButton.style.backgroundColor = '#ea0707';
                            editSaveButton.style.cursor = 'pointer';
                            editSaveButton.style.color = 'white';
                            editSaveButton.style.opacity = '1';
                        }
                    });
                }
            });
        });

        // Script untuk toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                // Toggle tipe input
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        function showSuperadminWarning() {
            Swal.fire({
                toast: true,
                icon: 'warning',
                title: 'Superadmin utama tidak dapat diubah, dihapus, atau dinonaktifkan.',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        }
    </script>
@endsection
