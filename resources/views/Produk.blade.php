@extends('layouts.app')

@section('content')

<div class="container">
    
    <h2>Daftar Produk</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
            <tr>
                <td>{{ $item->idProduk }}</td>
                <td>{{ $item->namaProduk }}</td>
                <td>Rp {{ number_format($item->hargaProduk, 0, ',', '.') }}</td>
                <td>
                    <img src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}" width="100">
                </td>
                <td>{{ $item->kategoriProduk }}</td>
                <td>{{ $item->deskripsiProduk }}</td>
                <td>
                    <a href="{{ route('produk.edit', $item->idProduk) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produk.destroy', $item->idProduk) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
