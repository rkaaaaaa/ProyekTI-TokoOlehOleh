@extends('layouts.app') <!-- Pastikan ini adalah layout utama yang kamu gunakan -->

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="mt-4">
            <h3>Daftar Produk</h3>

            @if ($produk->isEmpty())
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
                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $item->namaProduk }}</td>
                                <td>{{ $item->hargaProduk }}</td>
                                <td>
                                    <!-- Tombol untuk mengedit dan menghapus produk -->
                                    <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
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
