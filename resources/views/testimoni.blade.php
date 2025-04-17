@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Data Testimoni</h2>

    <a href="{{ route('testimoni.create') }}" class="btn btn-primary mb-3">Tambah Testimoni</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($testimoni as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->gambarTestimoni) }}" 
                            alt="Testimoni Gambar" style="max-width: 100px; border-radius: 6px;">
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggalTestimoni)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('testimoni.edit', $item->idTestimoni) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('testimoni.destroy', $item->idTestimoni) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus testimoni ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data testimoni.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
