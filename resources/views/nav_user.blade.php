<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Tailwind</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-red': '#e60000',
                        'hover-color': '#FFC300',
                        'black': '#222222',
                        'white': '#ffffff',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-gray-100">

<!-- Navbar -->
<nav class="bg-primary-red py-4 shadow-md fixed top-0 w-full z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('page.home') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[50px] transition-transform hover:scale-110">
        </a>

        <!-- Hamburger button (Mobile) -->
        <button id="menu-btn" class="lg:hidden text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Menu Items -->
        <div class="hidden lg:flex lg:items-center space-x-6" id="menu">
            <a href="{{ route('page.home') }}" class="text-white font-medium hover:text-hover-color {{ Request::is('/') ? 'text-hover-color font-bold' : '' }}">Home</a>
            <a href="{{ route('page.produk') }}" class="text-white font-medium hover:text-hover-color {{ Request::is('produk') ? 'text-hover-color font-bold' : '' }}">Produk</a>
            <a href="{{ route('kontak') }}" class="text-white font-medium hover:text-hover-color {{ Request::is('kontak') ? 'text-hover-color font-bold' : '' }}">Kontak</a>

            <!-- Dropdown -->
            <div class="relative group">
                <button class="text-white font-medium flex items-center gap-1 hover:text-hover-color">
                    Tentang Kami
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.35a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="absolute hidden group-hover:block bg-primary-red rounded-md shadow-md w-40 mt-2">
                    <a href="{{ route('sejarah') }}" class="block px-4 py-2 text-white hover:text-hover-color">Sejarah</a>
                    <a href="{{ route('page.lokasi') }}" class="block px-4 py-2 text-white hover:text-hover-color">Lokasi</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden lg:hidden bg-primary-red text-white px-4 py-2 space-y-2" id="mobile-menu">
        <a href="{{ route('page.home') }}" class="block hover:text-hover-color {{ Request::is('/') ? 'text-hover-color font-bold' : '' }}">Home</a>
        <a href="{{ route('page.produk') }}" class="block hover:text-hover-color {{ Request::is('produk') ? 'text-hover-color font-bold' : '' }}">Produk</a>
        <a href="{{ route('kontak') }}" class="block hover:text-hover-color {{ Request::is('kontak') ? 'text-hover-color font-bold' : '' }}">Kontak</a>
        <a href="{{ route('sejarah') }}" class="block hover:text-hover-color">Sejarah</a>
        <a href="{{ route('page.lokasi') }}" class="block hover:text-hover-color">Lokasi</a>
    </div>
</nav>

<!-- JavaScript untuk Toggle Mobile Menu -->
<script>
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

</body>
</html>
