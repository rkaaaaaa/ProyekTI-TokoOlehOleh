@extends('layouts.main')

@section('title', 'Temukan Produk Kami')
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">


@section('content')

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-3xl font-bold mb-6 text-primary-red">Temukan Produk Kami</h2>
                <p class="text-lg">
                    Sambel Pecel Madiun Asli Selo tersedia di berbagai lokasi untuk memudahkan Anda mendapatkan produk kami.
                    Kunjungi toko terdekat atau hubungi kami untuk informasi lebih lanjut.
                </p>
                <div class="w-24 h-1 bg-primary-red mx-auto mt-8"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tokos as $toko)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-primary-red rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $toko->namaToko }}</h3>
                            </div>
                            
                            <div class="flex items-start mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-red mt-1 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-gray-600">{{ $toko->alamatToko }}</p>
                            </div>
                            
                                
                                <span class="text-sm text-gray-500">
                                    @if(isset($toko->user->nama))
                                        Pengelola: {{ $toko->user->nama }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-bold text-gray-500 mb-2">Belum Ada Lokasi Toko</h3>
                        <p class="text-gray-500">Lokasi toko akan segera ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .hero-section {
            height: 50vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
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
@endsection
