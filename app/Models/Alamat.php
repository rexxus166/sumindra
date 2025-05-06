<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'no_tlp',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'nama_jalan',
        'gedung',
        'no_rumah',
        'user_id',
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}