<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'description',
        'price',
        'image',
        'stock',
        'toko_id',
        'variants',  // Kolom yang menyimpan varian dalam format JSON
    ];

    // Relasi dengan Toko
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    // Mengakses data varian
    public function getVariantsAttribute($value)
    {
        // Pastikan nilai yang diterima dalam bentuk array
        return is_array($value) ? $value : json_decode($value, true);  // Cek jika sudah array, langsung dikembalikan
    }
}