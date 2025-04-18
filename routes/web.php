<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LoginController;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TokoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// ==========================
// ROUTE UTAMA (FRONTEND)
// ==========================
Route::get('/', function () {
    return view('home');
})->name('page.home');

Route::get('/produk', function () {
    return view('userproduk');
})->name('page.produk');

Route::get('/kontak', function () {
    return view('usercontact');
})->name('kontak');

Route::get('/sejarah', function () {
    return view('usersejarah');
})->name('sejarah');

Route::get('/lokasi', function () {
    return view('userlokasi');
})->name('page.lokasi');

// ==========================
// ROUTE AUTENTIKASI
// ==========================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Jika butuh register
// Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// ==========================
// ROUTE DASHBOARD (SETELAH LOGIN)
// ==========================
Route::middleware('auth')->group(function () {
    // Redirect /dashboard ke halaman produk
    Route::get('/dashboard', fn() => redirect()->route('dashboard.produk'))->name('dashboard');

    // ======== PRODUK ========
    Route::get('/dashboard/produk', [ProdukController::class, 'index'])->name('dashboard.produk');
    Route::get('/dashboard/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/dashboard/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/dashboard/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/dashboard/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/dashboard/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // ======== TESTIMONI ========
    Route::prefix('dashboard/testimoni')->group(function () {
        Route::get('/', [TestimoniController::class, 'index'])->name('testimoni.index');
        Route::get('/tambah', [TestimoniController::class, 'create'])->name('testimoni.create');
        Route::post('/', [TestimoniController::class, 'store'])->name('testimoni.store');
        Route::get('/{id}/edit', [TestimoniController::class, 'edit'])->name('testimoni.edit');
        Route::put('/{id}', [TestimoniController::class, 'update'])->name('testimoni.update');
        Route::delete('/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
    });

    // ======== TOKO ========
    Route::prefix('dashboard/toko')->group(function () {
        Route::get('/', [TokoController::class, 'index'])->name('toko.index');
        Route::get('/create', [TokoController::class, 'create'])->name('toko.create');
        Route::post('/', [TokoController::class, 'store'])->name('toko.store');
        Route::get('/{toko}', [TokoController::class, 'show'])->name('toko.show');
        Route::get('/{toko}/edit', [TokoController::class, 'edit'])->name('toko.edit');
        Route::put('/{toko}', [TokoController::class, 'update'])->name('toko.update');
        Route::delete('/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy');
    });
});
