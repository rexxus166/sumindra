<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',   // Tambahkan slug ke dalam fillable
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
        return is_array($value) ? $value : json_decode($value, true);
    }

    // Mengatur pengisian slug otomatis
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $slug = Str::slug($product->name);

                // Mengecek apakah slug sudah ada di database
                $existingSlugCount = Product::where('slug', $slug)->count();

                // Jika slug sudah ada, tambahkan random text untuk membuatnya unik
                if ($existingSlugCount > 0) {
                    // Menghasilkan random string sepanjang 8 karakter
                    $randomString = Str::random(8);
                    $slug = $slug . '-' . $randomString;
                }

                $product->slug = $slug;
            }
        });
    }
}