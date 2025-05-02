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

        .preview-card {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 20px;
            background: #f8f9fa;
            text-align: center;
        }

        .preview-img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border: 1px dashed #ccc;
            border-radius: 15px;
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
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Data Testimoni</h4>
        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-custom" style="background-color: #ea0707; color: white;" data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Testimoni
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
                    @forelse($testimoni as $i => $t)
                        <tr>
                            <td>{{ $testimoni->firstItem() + $i }}</td>
                            <td><img src="{{ asset('storage/' . $t->gambarTestimoni) }}"
                                    style="max-width:100px;border-radius:6px"></td>
                            <td>{{ \Carbon\Carbon::parse($t->tanggalTestimoni)->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit" data-id="{{ $t->idTestimoni }}"
                                    data-gambar="{{ asset('storage/' . $t->gambarTestimoni) }}"
                                    data-tanggal="{{ $t->tanggalTestimoni }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form id="formDelete" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-custom btn-delete"
                                        data-id="{{ $t->idTestimoni }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada data testimoni.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0" style="font-size: 0.9rem;">
                    Menampilkan <span style="font-weight: bold;">{{ $testimoni->firstItem() }}</span> hingga <span
                        style="font-weight: bold;">{{ $testimoni->lastItem() }}</span> dari total <span
                        style="font-weight: bold;">{{ $testimoni->total() }}</span> testimoni
                </p>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item {{ $testimoni->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $testimoni->previousPageUrl() }}"
                                style="background-color: #ea0707; color: white;">
                                Previous
                            </a>
                        </li>

                        @for ($i = 1; $i <= $testimoni->lastPage(); $i++)
                            <li class="page-item {{ $testimoni->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $testimoni->url($i) }}"
                                    style="{{ $testimoni->currentPage() == $i ? 'background-color: rgba(255, 0, 0, 0.2); color: red; font-weight: bold;' : 'color: red;' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor

                        <li class="page-item {{ !$testimoni->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $testimoni->nextPageUrl() }}"
                                style="background-color: #ea0707; color: white;">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Tambah Testimoni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambarTestimoni" class="form-control" accept="image/*"
                                    onchange="previewImage(this,'prevAdd')" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggalTestimoni" id="addTanggal" class="form-control"
                                    onchange="updateDate(this,'dateAdd')" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="preview-card">
                                <h5>Preview</h5>
                                <img id="prevAdd" src="{{ asset('assets/placeholder.png') }}" class="preview-img">
                                <p><strong>Tanggal:</strong> <span id="dateAdd">-</span></p>
                            </div>
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
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-warning">Edit Testimoni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEdit" method="POST" enctype="multipart/form-data" onsubmit="return confirmSave(event)">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="idTestimoni">
                    <div class="modal-body row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambarTestimoni" class="form-control" accept="image/*"
                                    onchange="previewImage(this,'prevEdit')">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggalTestimoni" id="editTanggal" class="form-control"
                                    onchange="updateDate(this,'dateEdit')" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="preview-card">
                                <h5>Preview</h5>
                                <img id="prevEdit" src="{{ asset('assets/placeholder.png') }}" class="preview-img">
                                <p><strong>Tanggal:</strong> <span id="dateEdit">-</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-0">
                        <button type="submit" class="btn btn-warning w-100 mt-3"><i class="fas fa-save me-1"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview dan tanggal
        function previewImage(input, targetId) {
            if (!input.files[0]) return;
            const reader = new FileReader();
            reader.onload = e => document.getElementById(targetId).src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }

        function updateDate(input, targetId) {
            const txt = new Date(input.value).toLocaleDateString();
            document.getElementById(targetId).innerText = txt || '-';
        }

        // // Konfirmasi simpan
        function confirmSave(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Yakin ingin menyimpan perubahan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6'
            }).then(res => res.isConfirmed && e.target.submit());
            return false;
        }

        // Modal Edit handler
        document.getElementById('modalEdit').addEventListener('show.bs.modal', e => {
            const btn = e.relatedTarget;
            const id = btn.dataset.id;
            const gambar = btn.dataset.gambar;
            const tanggal = btn.dataset.tanggal;

            const form = document.getElementById('formEdit');
            form.action = '/dashboard/testimoni/' + id;

            document.getElementById('editId').value = id;
            document.getElementById('editTanggal').value = tanggal;
            updateDate({
                value: tanggal
            }, 'dateEdit');
            document.getElementById('prevEdit').src = gambar;
        });

        // Delete handler
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                Swal.fire({
                    title: 'Hapus Testimoni?',
                    text: 'Data akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                }).then(result => {
                    if (result.isConfirmed) {
                        // Mengirim request untuk menghapus data
                        const form = document.getElementById('formDelete');
                        form.action = '/dashboard/testimoni/' + id;
                        form.submit(); // Submit form untuk menghapus
                    }
                });
            });
        });
    </script>
@endsection
