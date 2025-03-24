@extends('layouts.app') <!-- Pastikan ini adalah layout utama yang kamu gunakan -->

@section('content')
<div class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.produk') }}">Kelola Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Halaman (Langsung Menampilkan Produk) -->
    <div class="mt-4">
        <h3>Daftar Produk</h3>
        
        @if($produk->isEmpty())
            <p>Tidak ada produk yang tersedia.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $item)
                        <tr>
                            <td>{{ $item->namaProduk }}</td>
                            <td>{{ $item->hargaProduk }}</td>
                            <td>
                                <!-- Tombol untuk mengedit dan menghapus produk -->
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
