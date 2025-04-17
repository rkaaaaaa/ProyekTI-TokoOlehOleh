@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="fw-bold mb-3">Data Toko</h4>

        <a href="{{ route('toko.create') }}" class="btn btn-primary mb-3">Tambah Toko</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nama Toko</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tokos as $toko)
                    <tr>
                        <td>{{ $toko->idToko }}</td>
                        <td>{{ $toko->namaToko }}</td>
                        <td>{{ $toko->alamatToko }}</td>
                        <td>
                            <a href="{{ route('toko.edit', $toko->idToko) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('toko.destroy', $toko->idToko) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus toko ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data toko.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
