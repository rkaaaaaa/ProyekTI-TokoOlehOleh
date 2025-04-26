<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-red: #D40000;
            --hover-color: #FFD700;
            --white: #ffffff;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
        }

        .navbar {
            background-color: var(--primary-red);
            padding: 12px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 45px;
            transition: transform 0.2s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.15);
        }

        .navbar-nav .nav-link {
            color: var(--white);
            font-weight: 500;
            font-size: 15px;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin: 0 3px;
        }

        .navbar-nav .nav-link:hover {
            color: var(--hover-color);
            background-color: transparent;
        }

        .navbar-nav .nav-link.active {
            color: var(--hover-color) !important;
            font-weight: 600;
        }

        .dropdown-menu {
            background-color: var(--primary-red);
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 8px 0;
            margin-top: 10px;
        }

        .dropdown-item {
            color: var(--white);
            padding: 8px 20px;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--hover-color);
        }

        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 5px 0;
        }

        .icon-profile {
            font-size: 22px;
            color: var(--white);
        }

        .dropdown-toggle::after {
            display: none;
        }

        .user-profile {
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.1);
            padding: 6px 15px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .user-name {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .navbar-toggler {
            border: none;
            color: white;
            padding: 5px 10px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-divider {
            height: 30px;
            width: 1px;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 0 10px;
        }

        @media (max-width: 991.98px) {
            .navbar-nav .nav-link {
                padding: 10px 15px;
                margin: 5px 0;
            }

            .user-profile {
                margin-top: 10px;
                justify-content: flex-start;
            }

            .navbar-divider {
                display: none;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand me-4" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                    onerror="this.src='https://via.placeholder.com/150x45?text=LOGO'">
            </a>

            <!-- Tombol Toggle untuk Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>

                    <div class="navbar-divider d-none d-lg-block"></div>

                    <!-- Menu Kelola Data -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/produk*') ? 'active' : '' }}"
                            href="{{ route('dashboard.produk') }}">
                            <i class="bi bi-box me-1"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/toko*') ? 'active' : '' }}"
                            href="{{ route('toko.index') }}">
                            <i class="bi bi-shop me-1"></i> Toko
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/testimoni*') ? 'active' : '' }}"
                            href="{{ url('/dashboard/testimoni') }}">
                            <i class="bi bi-chat-quote me-1"></i> Testimoni
                        </a>
                    </li>
                </ul>

                <!-- User Profile & Notifications -->
                <div class="d-flex align-items-center">

                    <!-- User Profile Dropdown -->
                    @if (auth()->check())
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle user-profile" href="#" id="profileDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle icon-profile me-2"></i>
                                <span
                                    class="text-white user-name">{{ auth()->user()->namaUser ?? auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down text-white ms-2"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li>
                                    <div class="dropdown-item-text text-white opacity-75 small px-3">
                                        Login sebagai <strong>{{ auth()->user()->levelUser ?? 'User' }}</strong>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                @if (auth()->user()->levelUser === 'Superadmin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="bi bi-shield-lock me-2"></i> Admin
                                        </a>
                                    </li>
                                @endif
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="logoutConfirm()">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function logoutConfirm() {
            Swal.fire({
                title: 'Konfirmasi Keluar',
                text: "Apakah Anda yakin ingin keluar dari akun ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D40000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        }
    </script>
</body>

</html>
