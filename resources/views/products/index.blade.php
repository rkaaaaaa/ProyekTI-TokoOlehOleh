<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambel Pecel Madiun Asli Selo</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
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
                <div class="ml-2">
                    <h1 class="text-xl font-bold">Sambel Pecel Madiun</h1>
                    <h2 class="text-2xl font-bold text-yellow-300">ASLI SELO</h2>
                    <p class="text-sm">Kualitas Premium</p>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 text-xl font-semibold">
                <a href="{{ route('page.home') }}" class="hover:text-yellow-300">Beranda</a>
                <a href="{{ route('products.index') }}" class="hover:text-yellow-300">Produk</a>
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
            <form action="{{ route('products.search') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search" class="w-full py-2 pl-10 pr-4 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-brand-red">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="p-4">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-contain mx-auto">
                    <h3 class="text-xl font-bold mt-4">{{ $product->name }}</h3>
                    
                    @if($product->variant)
                    <div class="mt-1">
                        <span>Varian:</span>
                        <span class="font-bold">{{ $product->variant }}</span>
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <span class="text-2xl font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
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
</body>
</html>
