@extends('layouts.main')

@section('title', 'Kontak')
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


@section('content')
<div class="container mx-auto py-16 px-8 md:px-16 font-poppins">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <div>
      <h2 class="text-4xl font-bold text-red-600 mb-6">Hubungi Kami</h2>
      <p class="text-gray-700 mb-8 leading-relaxed">
        Bila Anda memiliki pertanyaan lain yang mungkin belum terjawab di website kami, silahkan hubungi kami melalui kontak di bawah ini.
      </p>
      <ul class="space-y-6 text-gray-800 text-base">
  
        <li class="flex items-start gap-3 transition transform hover:scale-105 hover:text-red-600">
          <i class="bi bi-geo-alt text-2xl text-red-600"></i>
          <a href="https://maps.google.com/?q=Jl. Sido Mulyo I No.10, RT.46/RW.11, Kanigoro, Kec. Kartoharjo, Kota Madiun, Jawa Timur 63118" 
             class="hover:underline" 
             target="_blank" 
             rel="noopener noreferrer">
            Alamat: Jl. Sido Mulyo I No.10, RT.46/RW.11, Kanigoro,<br> Kec. Kartoharjo, Kota Madiun, Jawa Timur 63118
          </a>
        </li>
      
  
        <li class="flex items-center gap-3 transition transform hover:scale-105 hover:text-green-500">
          <i class="bi bi-whatsapp text-2xl text-green-500"></i>
          <a href="https://wa.me/6285708945396" 
             class="hover:underline" 
             target="_blank" 
             rel="noopener noreferrer">
            +62 857-0894-5396
          </a>
        </li>
      
  
        <li class="flex items-center gap-3 transition transform hover:scale-105 hover:text-pink-500">
          <i class="bi bi-instagram text-2xl text-pink-500"></i>
          <a href="https://instagram.com/sambelasliselo" 
             class="hover:underline" 
             target="_blank" 
             rel="noopener noreferrer">
            @sambelasliselo
          </a>
        </li>
      
  
        <li class="flex items-center gap-3 transition transform hover:scale-105 hover:text-blue-600">
          <i class="bi bi-facebook text-2xl text-blue-600"></i>
          <a href="https://facebook.com/Sambel-Pecel-Asli-Selo" 
             class="hover:underline" 
             target="_blank" 
             rel="noopener noreferrer">
            Sambel Pecel Asli Selo
          </a>
        </li>
      
        <li class="flex items-center gap-3 transition transform hover:scale-105 hover:text-black">
          <i class="bi bi-tiktok text-2xl text-black"></i>
          <a href="https://www.tiktok.com/@sambelasliselo" 
             class="hover:underline" 
             target="_blank" 
             rel="noopener noreferrer">
            Sambel Pecel Asli Selo
          </a>
        </li>
      </ul>
      
    </div>

    <div class="flex justify-center ml-10">
      <img src="{{ asset('images/hubungi-kami.png') }}" alt="Ilustrasi Kontak" class="max-w-xs md:max-w-md w-full">
    </div>

  </div>
</div>

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

