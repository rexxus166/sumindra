<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Toko;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'toko_id',
        'name',
        'category',
        'description',
        'price',
        'stock',
        'image',
        'variants',
    ];

    /**
     * Relasi dengan Toko (hanya untuk admin)
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
