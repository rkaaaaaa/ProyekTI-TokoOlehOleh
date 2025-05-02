@extends('layouts.main')

@section('title', 'Produk')

@section('content')
<style>
    body {
        position: relative;
    }
    
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("{{ asset('images/texture-whites.png') }}");
        background-repeat: repeat;
        opacity: 0.1;
        z-index: -1;
        transition: transform 3000ms ease-in-out;
    }
    
    .product-card {
        transition: transform 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="max-w-md mx-auto my-8">
    <form action="{{ route('produk.search') }}" method="GET" class="relative">
        <input type="text" name="search" placeholder="Search" class="w-full py-2 pl-10 pr-4 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-red">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </form>
</div>

<div class="flex justify-center mb-8">
    <div class="flex space-x-4">
        <a href="{{ route('produk.user') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('produk.user') && !request('kategori') ? 'bg-primary-red text-white border-2 border-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Semua
        </a>
        <a href="{{ route('produk.user', ['kategori' => 'Sambel']) }}" class="px-4 py-2 rounded-full {{ request('kategori') == 'Sambel' ? 'bg-primary-red text-white border-2 border-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Sambel
        </a>
        <a href="{{ route('produk.user', ['kategori' => 'Makanan']) }}" class="px-4 py-2 rounded-full {{ request('kategori') == 'Makanan' ? 'bg-primary-red text-white border-2 border-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Makanan
        </a>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @foreach($produk as $item)
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm product-card">
        <a href="{{ route('produk.detail', $item->idProduk) }}">
            <img class="p-8 rounded-t-lg h-48 object-contain mx-auto" src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}">
        </a>
        <div class="px-5 pb-5">
            <a href="{{ route('produk.detail', $item->idProduk) }}">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ $item->namaProduk }}</h5>
            </a>

            @if(strpos($item->namaProduk, 'Sambel') !== false && strpos($item->deskripsiProduk, 'Varian:') !== false)
                @php
                    preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $item->deskripsiProduk, $matches);
                    $varian = isset($matches[1]) ? $matches[1] : '';
                @endphp
                @if($varian)
                <div class="mt-1">
                    <span>Varian: </span>
                    <span class="font-bold">{{ $varian }}</span>
                </div>
                @endif
            @endif

            <div class="flex items-center mt-2.5 mb-5">
                <div class="flex items-center space-x-1">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03 3.656-3.563a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                    @endfor
                </div>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold text-gray-900">Rp{{ number_format($item->hargaProduk, 0, ',', '.') }}</span>
                <a href="{{ route('produk.detail', $item->idProduk) }}" class="text-white bg-primary-red hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if(count($produk) == 0)
<div class="text-center py-12">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
    </svg>
    <h3 class="mt-4 text-xl font-medium text-gray-600">Tidak ada produk ditemukan</h3>
    <p class="mt-2 text-gray-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
</div>
@endif
@endsection
