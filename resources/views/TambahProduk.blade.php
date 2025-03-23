@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-danger fw-bold">Tambah Produk</h2>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" oninput="updatePreview()">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">ID Gambar</label>
                    <input type="number" class="form-control" name="idUser" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" name="namaProduk" id="namaProduk" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" name="hargaProduk" id="hargaProduk" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambarProduk" id="gambarProduk" accept="image/*" onchange="previewImage(event)" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsiProduk" rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Produk</label>
                    <select class="form-control" name="kategoriProduk" id="kategoriProduk" required>
                        <option value="Sambel">Sambel</option>
                        <option value="Makanan">Makanan</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-danger">Simpan</button>
            </form>
        </div>
        
        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-center">Preview Produk</h5>
                <img id="previewImage" src="" class="img-fluid d-none" alt="Preview Gambar">
                <p><strong>Nama Produk:</strong> <span id="previewNama">-</span></p>
                <p><strong>Varian:</strong> <span id="previewVarian">-</span></p>
                <p><strong>Harga:</strong> <span id="previewHarga">Rp -</span></p>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('previewImage');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.classList.remove('d-none');
}

function updatePreview() {
    document.getElementById('previewNama').textContent = document.getElementById('namaProduk').value || '-';
    const harga = document.getElementById('hargaProduk').value;
    document.getElementById('previewHarga').textContent = harga ? 'Rp ' + harga : 'Rp -';
    document.getElementById('previewVarian').textContent = document.getElementById('kategoriProduk').value || '-';
}
</script>
@endsection
