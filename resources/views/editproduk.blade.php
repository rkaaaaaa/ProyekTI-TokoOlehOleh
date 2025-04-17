@extends('layouts.app')

@section('content')
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
    <h4 class="fw-bold text-danger mb-4">Edit Produk</h4>
    <div class="row">
        <div class="col-md-7">
            <div class="rounded-box">
                <form action="{{ route('produk.update', $produk->idProduk) }}" method="POST" enctype="multipart/form-data" oninput="updatePreview()">
                    @csrf
                    @method('PUT')

                    {{-- ID User otomatis (readonly) --}}
                    <div class="mb-3">
                        <label class="form-label">ID User</label>
                        <input type="text" class="form-control" value="{{ Auth::id() }}" readonly>
                        <input type="hidden" name="idUser" value="{{ Auth::id() }}">
                    </div>

                    <div class="mb-3">
                        <label for="gambarProduk" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" name="gambarProduk" id="gambarProduk" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="namaProduk" id="namaProduk" class="form-control" placeholder="Nama Produk" value="{{ $produk->namaProduk }}" required>
                    </div>

                    <div class="mb-3">
                        <select name="kategoriProduk" id="kategoriProduk" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sambel" {{ $produk->kategoriProduk == 'Sambel' ? 'selected' : '' }}>Sambel</option>
                            <option value="Makanan" {{ $produk->kategoriProduk == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="hargaProduk" id="hargaProduk" class="form-control" placeholder="Harga" value="{{ $produk->hargaProduk }}" required>
                    </div>

                    <div class="mb-3">
                        <textarea name="deskripsiProduk" id="deskripsiProduk" class="form-control" rows="4" required>{{ $produk->deskripsiProduk }}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="preview-card">
                <h5>Preview Produk</h5>
                <img id="previewImage" src="{{ asset('storage/' . $produk->gambarProduk) }}" class="preview-img" alt="Preview">
                <p><strong>Nama Produk:</strong> <span id="previewNama">{{ $produk->namaProduk }}</span></p>
                <p><strong>Varian:</strong> <span id="previewVarian">{{ $produk->kategoriProduk }}</span></p>
                <p><strong>Harga:</strong> <span id="previewHarga">Rp {{ number_format($produk->hargaProduk, 0, ',', '.') }}</span></p>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('previewImage');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }

    function updatePreview() {
        document.getElementById('previewNama').textContent = document.getElementById('namaProduk').value || '-';
        document.getElementById('previewVarian').textContent = document.getElementById('kategoriProduk').value || '-';
        const harga = document.getElementById('hargaProduk').value;
        document.getElementById('previewHarga').textContent = harga ? 'Rp ' + harga : 'Rp -';
    }
</script>
@endsection
