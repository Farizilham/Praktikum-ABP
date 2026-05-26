<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'price', 'category_id']; // Ditambahkan category_id 

  // Relasi Inverse One-to-Many: Produk dimiliki oleh satu Kategori
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}