@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .rounded-box {
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            background-color: #fff;
        }

        .card-custom {
            border-radius: 25px;
            padding: 20px;
            background-color: #fafafa;
            text-align: center;
            height: 100%;
        }

        .card-custom .card-body {
            padding: 20px;
        }

        .card-custom .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-custom .card-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .card-custom .card-count {
            font-size: 30px;
            font-weight: bold;
        }
    </style>

    <div class="container mt-4">
        <h4 class="fw-bold text-danger mb-4">Dashboard</h4>

        <div class="row">
            <!-- Admin Card -->
            <div class="col-md-3">
                <a href="{{ route('admin.index') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-user-shield card-icon text-primary"></i>
                            <div>
                                <h5 class="card-title">Admin</h5>
                                <h3 class="card-count">{{ $adminCount }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Produk Card -->
            <div class="col-md-3">
                <a href="{{ route('dashboard.produk') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-box-open card-icon text-warning"></i>
                            <div>
                                <h5 class="card-title">Produk</h5>
                                <h3 class="card-count">{{ $produkCount }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Toko Card -->
            <div class="col-md-3">
                <a href="{{ route('toko.index') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-store card-icon text-success"></i>
                            <div>
                                <h5 class="card-title">Toko</h5>
                                <h3 class="card-count">{{ $tokoCount }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Testimoni Card -->
            <div class="col-md-3">
                <a href="{{ route('testimoni.index') }}" class="text-decoration-none">
                    <div class="card custom card-custom shadow mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="fas fa-comments card-icon text-danger"></i>
                            <div>
                                <h5 class="card-title">Testimoni</h5>
                                <h3 class="card-count">{{ $testimoniCount }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
