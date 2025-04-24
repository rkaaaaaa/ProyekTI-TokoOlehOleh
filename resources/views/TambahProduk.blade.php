@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        padding: 10px 30px;
        font-weight: bold;
        border: none;
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
                <form id="formProduk" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" oninput="updatePreview()">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">ID User</label>
                        <input type="text" class="form-control" value="{{ Auth::id() }}" readonly>
                        <input type="hidden" name="idUser" value="{{ Auth::id() }}">
                    </div>

                    <div class="mb-3">
                        <label for="gambarProduk" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" name="gambarProduk" id="gambarProduk" accept="image/*" onchange="previewImage(event)" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="namaProduk" id="namaProduk" class="form-control" placeholder="Nama Produk" required>
                    </div>

                    <div class="mb-3">
                        <select name="kategoriProduk" id="kategoriProduk" class="form-control" onchange="updatePreview()" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sambel">Sambel</option>
                            <option value="Makanan">Makanan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="hargaProduk" id="hargaProduk" class="form-control" placeholder="Harga" required>
                    </div>

                    <div class="mb-3">
                        <textarea name="deskripsiProduk" id="deskripsiProduk" class="form-control" placeholder="Deskripsi Produk" rows="4" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="preview-card">
                <h5>Preview Produk</h5>
                <img id="previewImage" src="{{ asset('assets/placeholder.png') }}" class="preview-img" alt="Preview">
                <p><strong>Nama Produk:</strong> <span id="previewNama">-</span></p>
                <p><strong>Kategori:</strong> <span id="previewVarian">-</span></p>
                <p><strong>Harga:</strong> <span id="previewHarga">Rp -</span></p>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewImage');
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    }

    function updatePreview() {
        document.getElementById('previewNama').textContent = document.getElementById('namaProduk').value || '-';
        document.getElementById('previewVarian').textContent = document.getElementById('kategoriProduk').value || '-';
        const harga = document.getElementById('hargaProduk').value;
        document.getElementById('previewHarga').textContent = harga ? 'Rp ' + harga : 'Rp -';
    }

    // SweetAlert2 untuk konfirmasi submit
    document.getElementById('formProduk').addEventListener('submit', function(e) {
        e.preventDefault();
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
                e.target.submit();
            }
        });
    });
</script>
@endsection
