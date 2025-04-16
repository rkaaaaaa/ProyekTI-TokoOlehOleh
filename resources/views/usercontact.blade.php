@extends('layouts.main')

@section('title', 'Kontak')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="container py-5" style="font-family: 'Poppins', sans-serif;">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0 ml-5">
          <h2 class="fw-bold text-danger">Hubungi Kami</h2>
          <p>
            Bila Anda memiliki pertanyaan lain yang mungkin belum terjawab di website kami, silahkan hubungi kami melalui <span style="white-space: nowrap;">kontak di bawah ini</span>.
          </p>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex">
                <i class="bi bi-geo-alt me-2 fs-3 mt-1"></i>
                <a href="https://maps.app.goo.gl/rH2BtCHE1yrzzGQx5" target="_blank" class="text-decoration-none text-dark">
                Jl. Sido Mulyo I No.10, RT.46/RW.11, Kanigoro, Kec. Kartoharjo, <br>Kota Madiun, Jawa Timur 63118
              </a>
            </li>
            <li class="mb-3">
              <i class="bi bi-whatsapp me-2 fs-4"></i>
              <a href="https://wa.me/6285708945396" target="_blank" class="text-decoration-none text-dark">
                +62 857-0894-5396
              </a>
            </li>
            <li class="mb-3">
              <i class="bi bi-instagram me-2 fs-4"></i>
              <a href="https://www.instagram.com/sambel.asliselo" target="_blank" class="text-decoration-none text-dark">
                @sambelasliselo
              </a>
            </li>
            <li class="mb-3">
              <i class="bi bi-facebook me-2 fs-4"></i>
              <a href="https://facebook.com/sambelpecelasliselo" target="_blank" class="text-decoration-none text-dark">
                Sambel Pecel Asli Selo
              </a>
            </li>
            <li class="mb-3">
              <i class="bi bi-tiktok me-2 fs-4"></i>
              <a href="https://www.tiktok.com/@sambel.selo" target="_blank" class="text-decoration-none text-dark">
                Sambel Pecel Asli Selo
              </a>
            </li>
          </ul>
        </div>
  
        <div class="col-md-6 text-center">
          <img src="{{ asset('images/hubungi-kami.png') }}" alt="Ilustrasi Kontak" class="img-fluid" style="max-width: 400px;">
        </div>
      </div>
    </div>
    
@endsection
