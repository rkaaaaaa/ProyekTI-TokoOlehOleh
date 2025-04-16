<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AuthenticateUser;


// Redirect root ke /dashboard (langsung ke daftar produk)
Route::get('/', function () {
    return view('home');
})->name('page.home');


Route::middleware('auth')->group(function () {
// Dashboard langsung mengarah ke /dashboard/produk
Route::get('/dashboard', function () {
    return redirect()->route('dashboard.produk');
})->name('dashboard');

// Rute Produk (Admin)

Route::get('/dashboard/produk', [ProdukController::class, 'index'])->name('dashboard.produk');
Route::get('/dashboard/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/dashboard/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/dashboard/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/dashboard/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/dashboard/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Rute Login
Route::middleware('guest')->group(function () {
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
});



// // Rute Register
// Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth','superadmin'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// Rute User
Route::get('/produk', function () {return view('userproduk');})->name('page.produk');
Route::get('/kontak', function () {return view('usercontact');})->name('kontak');
Route::get('/sejarah', function () {return view('usersejarah');})->name('sejarah');
Route::get('/lokasi', function () {return view('userlokasi');})->name('page.lokasi');
