@extends('layouts.main')

@section('title', 'Kontak')

@section('content')
<div class="container mx-auto py-16 px-6 font-poppins">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <!-- Kiri: Info Kontak -->
    <div>
      <h2 class="text-4xl font-bold text-red-600 mb-6">Hubungi Kami</h2>
      <p class="text-gray-700 mb-8 leading-relaxed">
        Bila Anda memiliki pertanyaan lain yang mungkin belum terjawab di website kami, silahkan hubungi kami melalui kontak di bawah ini.
      </p>
      <ul class="space-y-6 text-gray-800 text-base">
        <li class="flex items-start gap-3">
          <i class="bi bi-geo-alt text-2xl text-red-600"></i>
          <span>
            Alamat: Jl. Sido Mulyo I No.10, RT.46/RW.11, Kanigoro, Kec. Kartoharjo, Kota Madiun, Jawa Timur 63118
          </span>
        </li>
        <li class="flex items-center gap-3">
          <i class="bi bi-whatsapp text-2xl text-green-500"></i>
          <span>+62 857-0894-5396</span>
        </li>
        <li class="flex items-center gap-3">
          <i class="bi bi-instagram text-2xl text-pink-500"></i>
          <span>@sambelasliselo</span>
        </li>
        <li class="flex items-center gap-3">
          <i class="bi bi-facebook text-2xl text-blue-600"></i>
          <span>Sambel Pecel Asli Selo</span>
        </li>
        <li class="flex items-center gap-3">
          <i class="bi bi-tiktok text-2xl text-black"></i>
          <span>Sambel Pecel Asli Selo</span>
        </li>
      </ul>
    </div>

    <!-- Kanan: Gambar -->
    <div class="flex justify-center">
      <img src="{{ asset('images/hubungi-kami.png') }}" alt="Ilustrasi Kontak" class="max-w-xs md:max-w-md w-full">
    </div>

  </div>
</div>
@endsection
