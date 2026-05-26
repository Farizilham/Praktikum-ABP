@extends('layouts.template')

@section('title', $title . ' Produk')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">{{ $title }} Produk</h4>
        </div>
        <div class="card-body">
          <form method="POST"
            action="{{ $title == 'Tambah' ? route('products.store') : route('products.update', $product->id) }}">
            @csrf
            @if($title == 'Edit')
              @method('PUT')
            @endif

            <div class="mb-3">
              <label for="name" class="form-label">Nama Produk</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                value="{{ old('name', $product->name ?? '') }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Harga (Minimum Rp1.000.000)</label>
              <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                value="{{ old('price', $product->price ?? '') }}">
              @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection