@extends('layouts.template')

@section('title', 'Daftar Produk')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Produk</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
      </div>

      <table class="table table-bordered table-striped bg-white shadow-sm">
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
              <td>{{ $product->category->category_name ?? 'Tanpa Kategori' }}</td>
              <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection