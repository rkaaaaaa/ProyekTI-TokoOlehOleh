@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

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
            background: #fff;
        }

        .btn-custom {
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
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Data Toko</h4>
        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-custom" style="background-color: #ea0707; color: white;" data-bs-toggle="modal"
                    data-bs-target="#modalTambahToko">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Toko
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
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: '{{ $errors->first() }}',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                </script>
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
                        @forelse($tokos as $i => $toko)
                            <tr>
                                <td>{{ $tokos->firstItem() + $i }}</td>
                                <td>{{ $toko->namaToko }}</td>
                                <td>{{ $toko->alamatToko }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-custom" data-bs-toggle="modal"
                                        data-bs-target="#modalEditToko" data-id="{{ $toko->idToko }}"
                                        data-nama="{{ $toko->namaToko }}" data-alamat="{{ $toko->alamatToko }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-custom btn-delete"
                                        data-id="{{ $toko->idToko }}">
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
                <!-- Pagination -->
                <div class="pagination-nav mt-3">
                    <p class="pagination-info mb-0">
                        Menampilkan <strong>{{ $tokos->firstItem() }}</strong> hingga
                        <strong>{{ $tokos->lastItem() }}</strong> dari total <strong>{{ $tokos->total() }}</strong>
                        admin
                    </p>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item {{ $tokos->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $tokos->previousPageUrl() }}" aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>

                            @for ($i = 1; $i <= $tokos->lastPage(); $i++)
                                <li class="page-item {{ $tokos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $tokos->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item {{ !$tokos->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $tokos->nextPageUrl() }}" aria-label="Next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahToko" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Tambah Toko</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('toko.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Toko</label>
                            <input type="text" name="namaToko" class="form-control" required
                                value="{{ old('namaToko') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Toko</label>
                            <input type="text" name="alamatToko" class="form-control" required
                                value="{{ old('alamatToko') }}">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-save w-100"><i class="fas fa-save me-1"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEditToko" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Edit Toko</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditToko" method="POST" onsubmit="return confirmSave(event,'Edit')">
                    @csrf @method('PUT')
                    <input type="hidden" name="idUser" value="{{ Auth::id() }}">
                    <div class="modal-body">
                        <input type="hidden" id="editIdToko" name="idToko">
                        <div class="mb-3">
                            <label class="form-label">Nama Toko</label>
                            <input type="text" id="editNamaToko" name="namaToko" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Toko</label>
                            <input type="text" id="editAlamatToko" name="alamatToko" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-save w-100"><i class="fas fa-save me-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // SweetAlert confirm
        function confirmSave(e, mode) {
            e.preventDefault();
            Swal.fire({
                title: mode + ' Toko?',
                text: 'Pastikan data sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6'
            }).then(res => {
                if (res.isConfirmed) e.target.submit();
            });
            return false;
        }

        // Populate Edit Modal
        const editModal = document.getElementById('modalEditToko');
        editModal.addEventListener('show.bs.modal', event => {
            const btn = event.relatedTarget;
            const id = btn.dataset.id;
            const nama = btn.dataset.nama;
            const alamat = btn.dataset.alamat;

            document.getElementById('editIdToko').value = id;
            document.getElementById('editNamaToko').value = nama;
            document.getElementById('editAlamatToko').value = alamat;
            document.getElementById('formEditToko').action = `/dashboard/toko/${id}`;
        });

        // Delete with confirmation
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                Swal.fire({
                    title: 'Hapus Toko?',
                    text: 'Data toko akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33'
                }).then(res => {
                    if (res.isConfirmed) {
                        const f = document.createElement('form');
                        f.method = 'POST';
                        f.action = `/dashboard/toko/${id}`;
                        f.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(f);
                        f.submit();
                    }
                });
            });
        });
    </script>
@endsection
