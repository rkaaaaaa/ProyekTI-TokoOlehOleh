<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-red: #D40000;
            --hover-color: #FFD700;
            --black: #222222;
            --white: #ffffff;
        }

        .navbar {
            background-color: var(--primary-red);
            padding: 15px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            color: var(--hover-color) !important;
            font-weight: 600;
        }


        .navbar-brand img {
            height: 50px;
            transition: transform 0.2s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.15);
        }

        .navbar-nav .nav-link {
            color: var(--white);
            font-weight: 500;
            font-size: 16px;
            margin: 0 15px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--hover-color);
        }

        .navbar-nav .nav-link.active {
            color: var(--hover-color) !important;
            font-weight: 600;
        }

        .dropdown-menu {
            background-color: var(--primary-red);
            /* Tetap merah */
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .dropdown-item {
            color: var(--white);
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: var(--primary-red);
            color: var(--hover-color);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .font-family {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('page.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('page.home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('page.produk') }}" class="nav-link {{ Request::is('produk') ? 'active' : '' }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kontak') }}" class="nav-link {{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('about*') ? 'active' : '' }}" href="#"
                            role="button">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('page.lokasi') }}">Lokasi</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
