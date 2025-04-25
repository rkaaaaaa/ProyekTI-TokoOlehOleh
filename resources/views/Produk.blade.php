@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .rounded-box {
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            background-color: #fff;
        }

        .btn-custom {
            border-radius: 12px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 12px;
        }
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Data Produk</h4>

        <div class="rounded-box shadow">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-custom">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Produk
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered text-center align-middle">
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
                                <a href="{{ route('produk.edit', $item->idProduk) }}" class="btn btn-warning btn-sm btn-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('produk.destroy', $item->idProduk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-custom" title="Hapus" onclick="return confirm('Hapus produk ini?')">
                                        <i class="fas fa-trash-alt"></i>
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
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                const productId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Hapus Produk?',
                    text: 'Apakah kamu yakin ingin menghapus produk ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.action = '/produk/' + productId;
                        form.method = 'POST';
                        form.innerHTML = '@csrf @method("DELETE")';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
