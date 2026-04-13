<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProductController;

// Menampilkan halaman welcome.blade.php
Route::get('/', function () {
    return view('welcome');
});

// Alternatif menggunakan Route::view
Route::view('/', 'welcome');

// Memanggil fungsi dari Controller
Route::post('/auth', [SiteController::class, 'auth']);

// Menggunakan route resource untuk ProductController
Route::resource('products', ProductController::class);

// Jika Anda ingin mendefinisikan route secara individual
Route::get('/products', [ProductController::class, 'index']);

Route::post('/auth', [SiteController::class, 'auth'])->name('auth');