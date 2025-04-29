@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
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
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Data Toko</h4>
        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#modalTambahToko">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Toko
                </button>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

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
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $toko->namaToko }}</td>
                            <td>{{ $toko->alamatToko }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#modalEditToko" data-id="{{ $toko->idToko }}"
                                    data-nama="{{ $toko->namaToko }}" data-alamat="{{ $toko->alamatToko }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-custom btn-delete" data-id="{{ $toko->idToko }}">
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahToko" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Tambah Toko</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('toko.store') }}" method="POST" onsubmit="return confirmSave(event,'Tambah')">
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
