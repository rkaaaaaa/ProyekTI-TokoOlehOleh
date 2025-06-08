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
            padding: 10px 20px;
            font-weight: bold;
            border: none;
        }

        .preview-card {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 20px;
            background: #f8f9fa;
        }

        .preview-img {
            width: 100%;
            max-width: 200px;
            border-radius: 8px;
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
        <h4 class="fw-bold text-danger mb-4">Data Produk</h4>
        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-custom" style="background-color: #ea0707; color: white;" data-bs-toggle="modal"
                    data-bs-target="#modalTambahProduk">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Produk
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
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Varian</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $i => $item)
                            <tr>
                                <td>{{ ($produk->currentPage() - 1) * $produk->perPage() + $i + 1 }}</td>
                                <td><img src="{{ asset('storage/' . $item->gambarProduk) }}"
                                        style="max-width:100px;border-radius:6px"></td>
                                <td>{{ $item->namaProduk }}</td>
                                <td>{{ $item->kategoriProduk }}</td>
                                <td>{{ $item->kategoriProduk == 'Sambel' && $item->varian ? $item->varian : '-' }}</td>
                                <td>Rp {{ number_format($item->hargaProduk, 0, ',', '.') }}</td>
                                <td>{{ $item->deskripsiProduk }}</td>
                                <td>
                                    <!-- Edit -->
                                    <button class="btn btn-warning btn-sm btn-custom" data-bs-toggle="modal"
                                        data-bs-target="#modalEditProduk" data-id="{{ $item->idProduk }}"
                                        data-nama="{{ $item->namaProduk }}" data-kategori="{{ $item->kategoriProduk }}"
                                        data-varian="{{ $item->varian }}" data-harga="{{ $item->hargaProduk }}"
                                        data-deskripsi="{{ $item->deskripsiProduk }}"
                                        data-gambar="{{ asset('storage/' . $item->gambarProduk) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Delete -->
                                    <form action="{{ route('produk.destroy', $item->idProduk) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-custom btn-delete"
                                            data-id="{{ $item->idProduk }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination-nav mt-3">
                    <p class="pagination-info mb-0">
                        Menampilkan <strong>{{ $produk->firstItem() }}</strong> hingga
                        <strong>{{ $produk->lastItem() }}</strong> dari total <strong>{{ $produk->total() }}</strong>
                        produk
                    </p>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item {{ $produk->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $produk->previousPageUrl() }}" aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>

                            @for ($i = 1; $i <= $produk->lastPage(); $i++)
                                <li class="page-item {{ $produk->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $produk->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item {{ !$produk->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $produk->nextPageUrl() }}" aria-label="Next">
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
    <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Tambah Produk</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="gambarProduk" id="gambarTambah" class="form-control"
                                    accept="image/*" onchange="previewImage(this,'prevTambah')" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="namaProduk" id="namaTambah" class="form-control"
                                    placeholder="Nama Produk" oninput="updatePreview('tambah')" required>
                            </div>
                            <div class="mb-3">
                                <select name="kategoriProduk" id="kategoriTambah" class="form-control"
                                    onchange="toggleVarian('tambah'); updatePreview('tambah')" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Sambel">Sambel</option>
                                    <option value="Makanan">Makanan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="varian" id="varianTambah" class="form-control" disabled
                                    onchange="updatePreview('tambah')">
                                    <option value="">-- Pilih Varian --</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Pedas">Pedas</option>
                                    <option value="Extra Pedas">Extra Pedas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="hargaProduk" id="hargaTambah" class="form-control"
                                    placeholder="Harga" oninput="updatePreview('tambah')" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="deskripsiProduk" id="deskripsiTambah" class="form-control" rows="4" placeholder="Deskripsi"
                                    oninput="updatePreview('tambah')" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="preview-card">
                                <h5>Preview Produk</h5>
                                <img id="prevTambah" src="{{ asset('assets/placeholder.png') }}" class="preview-img">
                                <p><strong>Nama:</strong> <span id="namaPrevTambah">-</span></p>
                                <p><strong>Kategori:</strong> <span id="kategoriPrevTambah">-</span></p>
                                <p><strong>Varian:</strong> <span id="varianPrevTambah">-</span></p>
                                <p><strong>Harga:</strong> <span id="hargaPrevTambah">Rp -</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-save w-100"><i class="fas fa-save me-1"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEditProduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3 rounded-box">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-danger">Edit Produk</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditProduk" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" id="editIdProduk" name="idProduk">
                    <div class="modal-body row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label">Gambar (opsional)</label>
                                <input type="file" name="gambarProduk" class="form-control" accept="image/*"
                                    onchange="previewImage(this,'prevEdit')">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="namaProduk" id="editNama" class="form-control"
                                    placeholder="Nama Produk" oninput="updatePreview('edit')" required>
                            </div>
                            <div class="mb-3">
                                <select name="kategoriProduk" id="editKategori" class="form-control"
                                    onchange="toggleVarian('edit'); updatePreview('edit')" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Sambel">Sambel</option>
                                    <option value="Makanan">Makanan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="varian" id="editVarian" class="form-control" disabled
                                    onchange="updatePreview('edit')">
                                    <option value="">-- Pilih Varian --</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Pedas">Pedas</option>
                                    <option value="Extra Pedas">Extra Pedas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="hargaProduk" id="editHarga" class="form-control"
                                    placeholder="Harga" oninput="updatePreview('edit')" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="deskripsiProduk" id="editDeskripsi" class="form-control" rows="4" placeholder="Deskripsi"
                                    oninput="updatePreview('edit')" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="preview-card">
                                <h5>Preview Produk</h5>
                                <img id="prevEdit" src="{{ asset('assets/placeholder.png') }}" class="preview-img">
                                <p><strong>Nama:</strong> <span id="namaPrevEdit">-</span></p>
                                <p><strong>Kategori:</strong> <span id="kategoriPrevEdit">-</span></p>
                                <p><strong>Varian:</strong> <span id="varianPrevEdit">-</span></p>
                                <p><strong>Harga:</strong> <span id="hargaPrevEdit">Rp -</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-save w-100"><i class="fas fa-save me-1"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleVarian(mode) {
            const select = mode === 'tambah' ? document.getElementById('kategoriTambah') : document.getElementById(
                'editKategori');
            const varSel = mode === 'tambah' ? document.getElementById('varianTambah') : document.getElementById(
                'editVarian');
            if (select.value === 'Sambel') varSel.disabled = false;
            else {
                varSel.disabled = true;
                varSel.value = '';
            }
        }

        function updatePreview(mode) {
            const namaEl = document.getElementById(mode === 'tambah' ? 'namaTambah' : 'editNama');
            const katEl = document.getElementById(mode === 'tambah' ? 'kategoriTambah' : 'editKategori');
            const varEl = document.getElementById(mode === 'tambah' ? 'varianTambah' : 'editVarian');
            const hrgtEl = document.getElementById(mode === 'tambah' ? 'hargaTambah' : 'editHarga');

            document.getElementById(mode === 'tambah' ? 'namaPrevTambah' : 'namaPrevEdit').textContent = namaEl.value ||
                '-';
            document.getElementById(mode === 'tambah' ? 'kategoriPrevTambah' : 'kategoriPrevEdit').textContent = katEl
                .value || '-';
            document.getElementById(mode === 'tambah' ? 'varianPrevTambah' : 'varianPrevEdit').textContent = varEl.value ||
                '-';
            const h = hrgtEl.value;
            document.getElementById(mode === 'tambah' ? 'hargaPrevTambah' : 'hargaPrevEdit').textContent = h ? ('Rp ' +
                parseInt(h).toLocaleString('id-ID')) : 'Rp -';
        }

        function previewImage(input, target) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById(target).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }


        document.getElementById('modalEditProduk')
            .addEventListener('show.bs.modal', e => {
                const btn = e.relatedTarget;
                const id = btn.dataset.id;
                document.getElementById('editIdProduk').value = id;
                document.getElementById('editNama').value = btn.dataset.nama;
                document.getElementById('editKategori').value = btn.dataset.kategori;
                toggleVarian('edit');
                document.getElementById('editVarian').value = btn.dataset.varian;
                document.getElementById('editHarga').value = btn.dataset.harga;
                document.getElementById('editDeskripsi').value = btn.dataset.deskripsi;
                document.getElementById('prevEdit').src = btn.dataset.gambar;
                updatePreview('edit');
                document.getElementById('formEditProduk').action = '/dashboard/produk/' + id;
            });
        // Delete with confirmation
        document.addEventListener('DOMContentLoaded', function() {
            // Seleksi semua tombol dengan class btn-delete
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Cegah submit langsung

                    const form = this.closest('form'); // Cari form terdekat

                    Swal.fire({
                        title: 'Hapus Produk?',
                        text: 'Apakah kamu yakin ingin menghapus Produk ini!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit jika dikonfirmasi
                        }
                    });
                });
            });
        });

    </script>
@endsection
