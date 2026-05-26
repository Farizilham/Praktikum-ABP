<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;

// Halaman Utama otomatis ke Login atau Products
Route::get('/', function () {
    return redirect('/login');
});

// Route Autentikasi Modul 12
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::post('/auth', [SiteController::class, 'auth'])->name('auth');

// Route Logout (Menghapus session dan keluar)
Route::get('/logout', function () {
    session()->flush(); // Menghapus semua data session 
    Auth::logout();     // Keluar dari sistem autentikasi
    return redirect('/login');
})->name('logout');

// Route CRUD Products
Route::resource('products', ProductController::class);