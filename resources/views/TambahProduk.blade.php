@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Menambahkan CDN Font Awesome untuk ikon -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .rounded-box {
        border: 2px solid #ccc;
        border-radius: 25px;
        padding: 20px;
        background-color: #fff;
    }

    .form-control {
        border-radius: 20px;
        padding: 10px 15px;
    }

    .btn-custom {
        background-color: red;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: bold;
        border: none;
    }

    .btn-back {
        background-color: #6c757d; /* Warna abu-abu gelap */
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: bold;
        border: none;
    }

    .btn-save {
        background-color: red; /* Warna merah untuk tombol Simpan */
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: bold;
        border: none;
    }

    .btn-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .preview-card {
        border: 2px solid #ddd;
        border-radius: 25px;
        padding: 20px;
        background-color: #fafafa;
        text-align: center;
        height: 100%;
    }

    .preview-img {
        max-height: 200px;
        object-fit: contain;
        border: 1px dashed #ccc;
        border-radius: 15px;
        margin-bottom: 10px;
    }

    input[type="file"]::file-selector-button {
        border: none;
        padding: 6px 15px;
        border-radius: 20px;
        background-color: #f2f2f2;
        margin-right: 10px;
        cursor: pointer;
    }
</style>

<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Tambah Produk</h4>
    <div class="row">
        <div class="col-md-7">
            <div class="rounded-box">

                {{-- Pesan Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formProduk" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="gambarProduk" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" name="gambarProduk" id="gambarProduk" accept="image/*" onchange="previewImage(event)" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="namaProduk" id="namaProduk" class="form-control" placeholder="Nama Produk" oninput="updatePreview()" required>
                    </div>

                    <div class="mb-3">
                        <select name="kategoriProduk" id="kategoriProduk" class="form-control" onchange="toggleVarian(); updatePreview()" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sambel">Sambel</option>
                            <option value="Makanan">Makanan</option>
                        </select>
                    </div>

                    <!-- Tambahan: Dropdown Varian -->
                    <div class="mb-3">
                        <select name="varian" id="varianProduk" class="form-control" disabled>
                            <option value="">-- Pilih Varian --</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Pedas">Pedas</option>
                            <option value="Extra Pedas">Extra Pedas</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="hargaProduk" id="hargaProduk" class="form-control" placeholder="Harga" oninput="updatePreview()" required>
                    </div>

                    <div class="mb-3">
                        <textarea name="deskripsiProduk" id="deskripsiProduk" class="form-control" placeholder="Deskripsi Produk" rows="4" oninput="updatePreview()" required></textarea>
                    </div>

                    <div class="btn-group">
                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                        <!-- Tombol Kembali -->
                        <a href="{{ url('/dashboard/produk') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-5">
            <div class="preview-card">
                <h5>Preview Produk</h5>
                <img id="previewImage" src="{{ asset('assets/placeholder.png') }}" class="preview-img" alt="Preview">
                <p><strong>Nama Produk:</strong> <span id="previewNama">-</span></p>
                <p><strong>Kategori:</strong> <span id="previewKategori">-</span></p>
                <p><strong>Varian:</strong> <span id="previewVarian">-</span></p>
                <p><strong>Harga:</strong> <span id="previewHarga">Rp -</span></p>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById('previewImage').src = URL.createObjectURL(file);
        }
    }

    function toggleVarian() {
        const kat = document.getElementById('kategoriProduk').value;
        const varSel = document.getElementById('varianProduk');
        if (kat === 'Sambel') {
            varSel.removeAttribute('disabled');
        } else {
            varSel.value = '';
            varSel.setAttribute('disabled', 'disabled');
        }
    }

    function updatePreview() {
        document.getElementById('previewNama').textContent = document.getElementById('namaProduk').value || '-';
        document.getElementById('previewKategori').textContent = document.getElementById('kategoriProduk').value || '-';
        document.getElementById('previewVarian').textContent = document.getElementById('varianProduk').value || '-';
        const harga = document.getElementById('hargaProduk').value;
        document.getElementById('previewHarga').textContent = harga ? 'Rp ' + harga : 'Rp -';
    }

    document.getElementById('formProduk').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: 'Simpan Produk?',
            text: 'Apakah kamu yakin ingin menyimpan produk ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
        toggleVarian();
    });
</script>
@endsection
