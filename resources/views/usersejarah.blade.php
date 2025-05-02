@extends('layouts.main')

@section('title', 'Sejarah')

@section('content')

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6 text-primary-red">Tentang Kami</h2>
            <p class="text-lg mb-8">
                Toko Oleh-Oleh 3R merupakan pusat oleh-oleh khas Madiun yang menyediakan berbagai produk unggulan seperti sambel pecel, snack tradisional, dan aneka makanan ringan lokal. 
                Berdiri sejak tahun 2010, toko ini menjadi destinasi favorit wisatawan yang ingin membawa pulang cita rasa khas Madiun. 
                Dengan mengedepankan kualitas, cita rasa autentik, dan pelayanan ramah, Toko Oleh-Oleh 3R terus berkomitmen melestarikan dan memperkenalkan kekayaan kuliner Madiun ke seluruh Indonesia.
            </p>
            <div class="w-24 h-1 bg-primary-red mx-auto mb-8"></div>
        </div>
    </div>
</section>

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

@endsection
