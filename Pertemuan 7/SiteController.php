<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SiteController extends Controller
{
  // Menampilkan halaman form login
  public function login()
  {
    return view('login');
  }

  // Memproses data input login (Autentikasi)
  public function auth(Request $req)
  {
    // Menggunakan Auth::attempt sesuai standar keamanan Laravel di modul
    if (Auth::attempt(['email' => $req->em, 'password' => $req->pwd])) {
      // Jika sukses login, arahkan ke halaman produk
      return redirect('/products');
    }

    // Jika gagal, kembalikan ke halaman login dengan pesan error
    return redirect('/login')->with('msg', 'Email atau Password salah!');
  }
}