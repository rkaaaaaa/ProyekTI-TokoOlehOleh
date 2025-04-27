<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambel Pecel Madiun ASLI SELO - Kualitas Premium</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-red': '#d80000',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            position: relative;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('images/texture-whites.png') }}");
            background-repeat: repeat;
            opacity: 0.1;
            z-index: -1;
        }
        
        .product-card {
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="font-sans">
    <!-- Header -->
    <header class="bg-brand-red text-white py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sambel Pecel Madiun" class="h-16">
            </div>
            
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 text-xl font-semibold">
                <a href="{{ route('page.home') }}" class="hover:text-yellow-300">Beranda</a>
                <a href="{{ route('produk.user') }}" class="hover:text-yellow-300">Produk</a>
                <a href="{{ route('kontak') }}" class="hover:text-yellow-300">Kontak</a>
            </nav>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Search Bar -->
        <div class="max-w-md mx-auto mb-8">
            <form action="{{ route('produk.search') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search" class="w-full py-2 pl-10 pr-4 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-brand-red">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>
        
        <!-- Category Filter -->
        <div class="flex justify-center mb-8">
            <div class="flex space-x-4">
                <a href="{{ route('produk.user') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('produk.user') && !request('kategori') ? 'bg-brand-red text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Semua
                </a>
                <a href="{{ route('produk.user', ['kategori' => 'Sambel']) }}" class="px-4 py-2 rounded-full {{ request('kategori') == 'Sambel' ? 'bg-brand-red text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Sambel
                </a>
                <a href="{{ route('produk.user', ['kategori' => 'Makanan']) }}" class="px-4 py-2 rounded-full {{ request('kategori') == 'Makanan' ? 'bg-brand-red text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Makanan
                </a>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($produk as $item)
            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="p-4">
                    <img src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}" class="w-full h-48 object-contain mx-auto">
                    <h3 class="text-xl font-bold mt-4">{{ $item->namaProduk }}</h3>
                    
                    @if(strpos($item->namaProduk, 'Sambel') !== false && strpos($item->deskripsiProduk, 'Varian:') !== false)
                        @php
                            preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $item->deskripsiProduk, $matches);
                            $varian = isset($matches[1]) ? $matches[1] : '';
                        @endphp
                        
                        @if($varian)
                        <div class="mt-1">
                            <span>Varian:</span>
                            <span class="font-bold">{{ $varian }}</span>
                        </div>
                        @endif
                    @endif
                    
                    <div class="mt-4">
                        <span class="text-2xl font-bold">Rp{{ number_format($item->hargaProduk, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('produk.detail', $item->idProduk) }}" class="bg-brand-red text-white px-4 py-2 rounded-md text-sm hover:bg-red-700 flex-1 text-center">
                            Detail
                        </a>
                        <button onclick="addToCart({{ $item->idProduk }})" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-900 flex-1">
                            Beli
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Empty State -->
        @if(count($produk) == 0)
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-600">Tidak ada produk ditemukan</h3>
            <p class="mt-2 text-gray-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
        </div>
        @endif
    </main>
    
    <!-- Footer -->
    <footer class="bg-brand-red text-white py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tentang Kami</h3>
                    <p>Sambel Pecel Madiun ASLI SELO menyediakan berbagai oleh-oleh khas Madiun dengan kualitas premium dan rasa autentik.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <p>Jl. Pahlawan No. 123, Madiun</p>
                    <p>Telp: 0351-123456</p>
                    <p>Email: info@asliselo.com</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Jam Operasional</h3>
                    <p>Senin - Sabtu: 08.00 - 17.00</p>
                    <p>Minggu: 09.00 - 15.00</p>
                </div>
            </div>
            <div class="mt-8 text-center">
                <p>&copy; {{ date('Y') }} Sambel Pecel Madiun ASLI SELO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function addToCart(productId) {
            // Implementasi fungsi untuk menambahkan produk ke keranjang
            // Bisa menggunakan AJAX untuk mengirim request ke server
            alert('Produk ditambahkan ke keranjang!');
        }
    </script>
</body>
</html>
