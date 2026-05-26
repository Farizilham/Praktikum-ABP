<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  // Menampilkan daftar produk 
  public function index()
  {
    $products = Product::all();
    return view('products.index', compact('products'));
  }

  // Menampilkan form tambah produk 
  public function create()
  {
    return view('products.form', ['title' => 'Tambah']);
  }

  // Menyimpan data produk baru dengan validasi 
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|min:4',
      'price' => 'required|integer|min:1000000',
    ]);

    Product::create($request->all()); // Mass assignment 

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
  }

  // Menampilkan form edit produk
  public function edit(Product $product)
  {
    return view('products.form', ['title' => 'Edit', 'product' => $product]);
  }

  // Memperbarui data produk dengan validasi 
  public function update(Request $request, Product $product)
  {
    $request->validate([
      'name' => 'required|min:4',
      'price' => 'required|integer|min:1000000',
    ]);

    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
  }

  // Menghapus data produk
  public function destroy(Product $product)
  {
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
  }
}