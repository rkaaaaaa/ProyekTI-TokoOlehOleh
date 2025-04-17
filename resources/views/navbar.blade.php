<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">

                {{-- KIRI: Menu Navigasi --}}
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Kelola Data
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard.produk') }}">Produk</a></li>
                            <li><a class="dropdown-item" href="{{ url('/dashboard/testimoni') }}">Testimoni</a></li>
                            <li><a class="dropdown-item" href="{{ route('toko.index') }}">Toko</a></li>
                        </ul>
                    </li>
                </ul>
                @if (auth()->check())
                    <form action="{{ route('logout') }}" method="POST" class="d-flex ms-auto"
                        onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                @endif
                {{-- TAMPILKAN HANYA UNTUK SUPERADMIN --}}
                @if (auth()->user()->role === 'superadmin')
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('admin.create') }}">Tambah Admin</a>
                    </li>
                @endif

            </div>
        </div>
    </nav>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
