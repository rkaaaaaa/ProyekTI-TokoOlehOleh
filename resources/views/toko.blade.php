@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4>Data Toko</h4>
        <a href="{{ route('toko.create') }}" class="btn btn-primary mb-3">+ Tambah Toko</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Toko</th>
                    <th>Alamat</th>
                    <th>Nama Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tokos as $toko)
                    <tr>
                        <td>{{ $toko->namaToko }}</td>
                        <td>{{ $toko->alamatToko }}</td>
                        <td>{{ $toko->user->namaUser ?? '-' }}</td>
                        <td>
                            <a href="{{ route('toko.edit', $toko->idToko) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('toko.destroy', $toko->idToko) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
