@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">ID User</label>
            <input type="number" class="form-control" name="idUser" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="namaProduk" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Harga Produk</label>
            <input type="number" class="form-control" name="hargaProduk" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" class="form-control" name="gambarProduk" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsiProduk" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori Produk</label>
            <select class="form-control" name="kategoriProduk" required>
                <option value="Sambel">Sambel</option>
                <option value="Makanan">Makanan</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>
@endsection
