<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;

// Halaman beranda di /beranda
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

// Halaman home di /home
Route::get('/home', [PesananController::class, 'index']);
Route::get('/pesan/detail/{id}', [PesananController::class, 'pesanDetail']);


// Halaman login di /login
Route::get('/login', [AuthController::class, 'index']);
Route::post('/register', [AuthController::class, 'authRegister']);
Route::post('/login', [AuthController::class, 'authLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile', [ProfilController::class, 'index'])->name('profile');
Route::get('/profile/{id}', [ProfilController::class, 'editProfile']);
Route::put('/profile/update/{id}', [ProfilController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/hapus/{id}', [ProfilController::class, 'hapusProfile'])->name('profile.hapus');

Route::get('/upload-produk', [ProductController::class, 'create'])->name('produk.create');
Route::post('/upload-produk', [ProductController::class, 'store'])->name('produk.store');
Route::get('/edit-produk/{id}', [ProductController::class, 'edit'])->name('produk.edit');
Route::post('/update-produk/{id}', [ProductController::class, 'update'])->name('produk.update');

Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products/report/{id}', [ProductController::class, 'report']);

Route::get('/laporan', [LaporanController::class, 'index']);

Route::get('/upload-produk', [ProductController::class, 'create']);

Route::get('/pesananku', function () {
    return view('pesananku');
});
