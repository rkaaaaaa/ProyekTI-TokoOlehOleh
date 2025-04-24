<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\DashboardController;


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
Route::middleware(['auth', SuperAdminMiddleware::class])->group(function () {
    Route::get('/register-admin', [UserController::class, 'create'])->name('register.form');
    Route::post('/register-admin', [UserController::class, 'store'])->name('register.store');

    // Route manajemen admin
    Route::get('/admin', [AdminManagementController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}/edit', [AdminManagementController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminManagementController::class, 'update'])->name('admin.update');
    Route::patch('/admin/{id}/toggle-status', [AdminManagementController::class, 'toggleStatus'])->name('admin.toggle-status');
    Route::delete('/admin/{id}', [AdminManagementController::class, 'destroy'])->name('admin.destroy');
});

// ==========================
// ROUTE DASHBOARD (SETELAH LOGIN)
// ==========================
Route::middleware('auth')->group(function () {

    // Sekarang tampilkan halaman dashboard:
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
