<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity'];  // Pastikan ini ada

    /**
     * Menyambungkan Cart dengan User (sebuah Cart milik satu User).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Menyambungkan Cart dengan Product (sebuah Cart berisi satu Produk).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}