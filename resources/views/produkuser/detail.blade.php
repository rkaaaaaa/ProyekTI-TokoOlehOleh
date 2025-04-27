<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->namaProduk }} - Sambel Pecel Madiun ASLI SELO</title>
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
    </style>
</head>
<body class="font-sans">
    <!-- Header -->
    <header class="bg-brand-red text-white py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sambel Pecel Madiun" class="h-16">
                <div class="ml-2">
                    <h1 class="text-xl font-bold">Sambel Pecel Madiun</h1>
                    <h2 class="text-2xl font-bold text-yellow-300">ASLI SELO</h2>
                    <p class="text-sm">Kualitas Premium</p>
                </div>
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
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('page.home') }}" class="text-gray-700 hover:text-brand-red">
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('produk.user') }}" class="ml-1 text-gray-700 hover:text-brand-red md:ml-2">
                            Produk
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">{{ $produk->namaProduk }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!-- Product Detail -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="{{ asset('storage/' . $produk->gambarProduk) }}" alt="{{ $produk->namaProduk }}" class="w-full h-auto object-contain">
            </div>
            
            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $produk->namaProduk }}</h1>
                
                @if(strpos($produk->namaProduk, 'Sambel') !== false && strpos($produk->deskripsiProduk, 'Varian:') !== false)
                    @php
                        preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $produk->deskripsiProduk, $matches);
                        $varian = isset($matches[1]) ? $matches[1] : '';
                    @endphp
                    
                    @if($varian)
                    <div class="mb-4">
                        <span class="text-gray-600">Varian:</span>
                        <span class="font-bold">{{ $varian }}</span>
                    </div>
                    @endif
                @endif
                
                <div class="text-3xl font-bold text-brand-red mb-6">
                    Rp{{ number_format($produk->hargaProduk, 0, ',', '.') }}
                </div>
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                    <p class="text-gray-700">{{ $produk->deskripsiProduk }}</p>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-2">Kategori</h2>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                        {{ $produk->kategoriProduk }}
                    </span>
                </div>
                
                <div class="flex space-x-4">
                    <div class="w-1/3">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-red">
                    </div>
                    
                    <button onclick="addToCart({{ $produk->idProduk }})" class="flex-1 bg-brand-red text-white px-6 py-2 rounded-md font-semibold hover:bg-red-700">
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Produk Terkait</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($related as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="p-4">
                        <img src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}" class="w-full h-48 object-contain mx-auto">
                        <h3 class="text-xl font-bold mt-4">{{ $item->namaProduk }}</h3>
                        
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
        </div>
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
            const quantity = document.getElementById('quantity')?.value || 1;
            // Implementasi fungsi untuk menambahkan produk ke keranjang
            // Bisa menggunakan AJAX untuk mengirim request ke server
            alert(`${quantity} produk ditambahkan ke keranjang!`);
        }
    </script>
</body>
</html>
