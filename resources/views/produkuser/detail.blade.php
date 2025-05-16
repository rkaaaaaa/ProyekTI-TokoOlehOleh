@extends('layouts.main')

@section('title', 'Produk')
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

@section('content')
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
    
    .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.85em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.375rem;
    }
    
    .badge-variant {
        background-color: #FEF2F2;
        color: #EF4444;
        border: 1px solid #FCA5A5;
    }
    
    .badge-category {
        background-color: #F3F4F6;
        color: #4B5563;
        border: 1px solid #E5E7EB;
    }
    
    .product-info-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #E5E7EB;
    }
    
    .product-info-section:last-child {
        border-bottom: none;
    }
    
    /* Hover animation for product cards */
    .product-card {
        transition: transform 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
</style>

<nav class="flex mb-8 mt-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('page.home') }}" class="text-gray-700 hover:text-primary-red">
                Beranda
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('produk.user') }}" class="ml-1 text-gray-700 hover:text-primary-red md:ml-2">
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

<div class="grid md:grid-cols-2 gap-8 mb-16">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <img src="{{ asset('storage/' . $produk->gambarProduk) }}" alt="{{ $produk->namaProduk }}" class="w-full h-auto object-contain">
    </div>
    
    <div>
        <h1 class="text-3xl font-bold mb-4">{{ $produk->namaProduk }}</h1>
        
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="badge badge-category">{{ $produk->kategoriProduk }}</span>
            
            @php
                $varian = '';
                // First check if varian field exists and has a value
                if ($produk->kategoriProduk == 'Sambel' && isset($produk->varian) && !empty($produk->varian)) {
                    $varian = $produk->varian;
                } 
                // If not, try to extract from description
                elseif ($produk->kategoriProduk == 'Sambel' && strpos($produk->deskripsiProduk, 'Varian:') !== false) {
                    preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $produk->deskripsiProduk, $matches);
                    $varian = isset($matches[1]) ? $matches[1] : '';
                }
            @endphp
            
            @if($produk->kategoriProduk == 'Sambel' && !empty($varian))
                <span class="badge badge-variant">{{ $varian }}</span>
            @endif
        </div>
        
        <div class="text-3xl font-bold text-primary-red mb-6 product-info-section">
            Rp{{ number_format($produk->hargaProduk, 0, ',', '.') }}
        </div>
        
        
        <div class="product-info-section">
            <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
            @php
                // Clean up description by removing the variant info if it exists
                $cleanDescription = $produk->deskripsiProduk;
                if ($produk->kategoriProduk == 'Sambel' && strpos($cleanDescription, 'Varian:') !== false) {
                    $cleanDescription = preg_replace('/Varian:\s*(.*?)(?:\s*\.|$)/i', '', $cleanDescription);
                    $cleanDescription = trim($cleanDescription);
                }
            @endphp
            <p class="text-gray-700">{{ $cleanDescription }}</p>
        </div>
        
        <div class="product-info-section">
            <div class="flex flex-col space-y-4">
                <div class="w-full">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-red h-[42px]">
                </div>
            
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" onclick="orderViaWhatsApp()" 
                        class="flex-1 bg-green-600 text-white px-6 rounded-md font-semibold hover:bg-green-700 flex items-center justify-center h-[42px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        Pesan via WhatsApp
                    </a>
            
                    <a href="https://www.tokopedia.com/asliselo" target="_blank" 
                        class="flex-1 bg-green-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-600 flex items-center justify-center h-[42px]">
                        <img src="{{ asset('images/logo-tokopedia.png') }}" alt="Tokopedia" style="width: 45px; height: 45px; margin-right: 8px;">
                        Beli di Tokopedia
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 mb-16">
    <h2 class="text-2xl font-bold mb-6">Produk Terkait</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($related as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 product-card">
            <div class="p-4">
                <a href="{{ route('produk.detail', $item->idProduk) }}">
                    <img src="{{ asset('storage/' . $item->gambarProduk) }}" alt="{{ $item->namaProduk }}" class="w-full h-48 object-contain mx-auto">
                </a>
                
                <a href="{{ route('produk.detail', $item->idProduk) }}">
                    <h3 class="text-xl font-bold mt-4 text-center">{{ $item->namaProduk }}</h3>
                </a>
                
                @php
                    $relatedVariant = '';
                    if ($item->kategoriProduk == 'Sambel' && isset($item->varian) && !empty($item->varian)) {
                        $relatedVariant = $item->varian;
                    } elseif ($item->kategoriProduk == 'Sambel' && strpos($item->deskripsiProduk, 'Varian:') !== false) {
                        preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $item->deskripsiProduk, $matches);
                        $relatedVariant = isset($matches[1]) ? $matches[1] : '';
                    }
                @endphp
                
                @if($item->kategoriProduk == 'Sambel' && !empty($relatedVariant))
                <div class="text-center mt-2">
                    <span class="badge badge-variant">{{ $relatedVariant }}</span>
                </div>
                @endif
                
                <div class="flex items-center justify-center mt-2.5 mb-5">
                    <div class="flex items-center space-x-1">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03 3.656-3.563a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        @endfor
                    </div>
                </div>
                
                <div class="text-center mb-4">
                    <span class="text-2xl font-bold">Rp{{ number_format($item->hargaProduk, 0, ',', '.') }}</span>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('produk.detail', $item->idProduk) }}" class="bg-primary-red text-white px-4 py-2 rounded-md text-sm hover:bg-red-700 block w-full text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function orderViaWhatsApp() {
        const quantity = document.getElementById('quantity')?.value || 1;
        const productName = "{{ $produk->namaProduk }}";
        const productPrice = "{{ number_format($produk->hargaProduk, 0, ',', '.') }}";
        
        @php
            $variantText = '';
            if ($produk->kategoriProduk == 'Sambel' && isset($produk->varian) && !empty($produk->varian)) {
                $variantText = $produk->varian;
            } elseif ($produk->kategoriProduk == 'Sambel' && strpos($produk->deskripsiProduk, 'Varian:') !== false) {
                preg_match('/Varian:\s*(.*?)(?:\s*\.|$)/i', $produk->deskripsiProduk, $matches);
                $variantText = isset($matches[1]) ? $matches[1] : '';
            }
        @endphp
        
        let message = `Halo, saya ingin memesan:\n\n*${productName}*`;
        
        @if($produk->kategoriProduk == 'Sambel' && !empty($variantText))
            message += `\nVarian: {{ $variantText }}`;
        @endif
        
        message += `\nJumlah: ${quantity}\nHarga: Rp${productPrice}/pcs\n\nMohon informasi lebih lanjut. Terima kasih.`;
        
        const encodedMessage = encodeURIComponent(message);
        const phoneNumber = "6285708945396"; 
        
        window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
    }
</script>
@endsection