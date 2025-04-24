@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container mt-4">
    <h2 class="mb-4">Data Produk</h2>

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}" style="max-width: 100px; border-radius: 6px;">
                </td>
                <td>{{ $item->namaProduk }}</td>
                <td>{{ $item->kategoriProduk }}</td>
                <td>Rp {{ number_format($item->hargaProduk, 0, ',', '.') }}</td>
                <td>{{ $item->deskripsiProduk }}</td>
                <td>
                    <a href="{{ route('produk.edit', $item->idProduk) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ route('produk.destroy', $item->idProduk) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Hapus produk ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Belum ada data produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
z