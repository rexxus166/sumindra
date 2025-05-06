<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'toko';  // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = [
        'nama_toko',
        'kategori_toko',
        'user_id',
    ];

    /**
     * Relasi dengan User (hanya untuk admin)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}