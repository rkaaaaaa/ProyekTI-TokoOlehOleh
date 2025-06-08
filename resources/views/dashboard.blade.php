@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/texture-whites.png') }}');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            opacity: 0.1;
            z-index: -1;
        }

        .rounded-box {
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            background-color: #fff;
        }

        .card-custom {
            border-radius: 25px;
            padding: 20px;
            background-color: #fafafa;
            text-align: center;
            height: 100%;
        }

        .card-custom .card-body {
            padding: 20px;
        }

        .card-custom .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-custom .card-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .card-custom .card-count {
            font-size: 30px;
            font-weight: bold;
        }

        .btn-custom {
            border-radius: 12px;
        }

        table td img {
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        table tbody tr {
            height: 80px;
            vertical-align: middle;
        }
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Dashboard</h4>

        <div class="row">
            <!-- Admin Card -->
            <div class="col-md-3">
                @if (Auth::user()->levelUser === 'Superadmin')
                    <a href="{{ route('admin.index') }}" class="text-decoration-none">
                        <div class="card custom card-custom shadow mb-4">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="fas fa-user-shield card-icon text-primary"></i>
                                <h5 class="card-title">Admin</h5>
                                <div class="card-count">{{ $adminCount + $superadminCount }}</div>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="#" class="text-decoration-none" onclick="showAlert(event)">
                        <div class="card custom card-custom shadow mb-4" style="opacity: 0.5; cursor: not-allowed;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <i class="fas fa-user-shield card-icon text-secondary"></i>
                                <h5 class="card-title">Admin</h5>
                                <div class="card-count">{{ $adminCount + $superadminCount }}</div>
                            </div>
                        </div>
                    </a>
                @endif
            </div>

            <!-- Produk Card -->
            <div class="col-md-3">
                <a href="{{ route('dashboard.produk') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-box-open card-icon text-warning"></i>
                            <h5 class="card-title">Produk</h5>
                            <div class="card-count">{{ $produkCount }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Toko Card -->
            <div class="col-md-3">
                <a href="{{ route('toko.index') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-store card-icon text-success"></i>
                            <h5 class="card-title">Toko</h5>
                            <div class="card-count">{{ $tokoCount }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Testimoni Card -->
            <div class="col-md-3">
                <a href="{{ route('testimoni.index') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-comments card-icon text-danger"></i>
                            <h5 class="card-title">Testimoni</h5>
                            <div class="card-count">{{ $testimoniCount }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="mt-4">
            <h5 class="fw-bold text-danger mb-4">Daftar Produk Terbaru</h5>
            <div class="table-responsive rounded-box mt-3">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Varian</th>
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
                                    <img src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}"
                                        style="max-width: 100px; border-radius: 6px;">
                                </td>
                                <td>{{ $item->namaProduk }}</td>
                                <td>{{ $item->kategoriProduk }}</td>
                                <td>{{ $item->kategoriProduk == 'Sambel' && $item->varian ? $item->varian : '-' }}</td>
                                <td>Rp {{ number_format($item->hargaProduk, 0, ',', '.') }}</td>
                                <td>{{ $item->deskripsiProduk }}</td>
                                <td>
                                    <a href="{{ route('produk.edit', $item->idProduk) }}"
                                        class="btn btn-warning btn-sm btn-custom" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $item->idProduk) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-custom btn-delete" title="Hapus">
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
    </div>

    <script>
        function showAlert(event) {
            event.preventDefault();

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: 'error',
                title: 'Anda tidak memiliki izin akses ke halaman admin.'
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Seleksi semua tombol dengan class btn-delete
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Cegah submit langsung

                    const form = this.closest('form'); // Cari form terdekat

                    Swal.fire({
                        title: 'Hapus Produk?',
                        text: 'Apakah kamu yakin ingin menghapus Produk ini!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>
@endsection
