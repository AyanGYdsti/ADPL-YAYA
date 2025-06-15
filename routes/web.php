<?php

use App\Http\Controllers\AuthController;
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
Route::get('/profile', [ProfilController::class, 'index']);
Route::post('/register', [AuthController::class, 'authRegister']);
Route::post('/login', [AuthController::class, 'authLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/upload-produk', [ProductController::class, 'create'])->name('produk.create');
Route::post('/upload-produk', [ProductController::class, 'store'])->name('produk.store');

Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products/report/{id}', [ProductController::class, 'report']);

Route::get('/upload-produk', [ProductController::class, 'create']);

Route::get('/pesananku', function () {
    return view('pesananku');
});
