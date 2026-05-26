<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['category_name'];

  // Relasi One-to-Many: Kategori memiliki banyak produk 
  public function products()
  {
    return $this->hasMany(Product::class);
  }
}