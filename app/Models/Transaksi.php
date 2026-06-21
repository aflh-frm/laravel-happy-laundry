<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_nota',
        'pelanggan_id',
        'layanan_id',
        'berat',
        'rincian_pakaian',
        'total_harga',
        'status'
    ];

    // Trik otomatis mengubah JSON di database menjadi Array di React
    protected $casts = [
        'rincian_pakaian' => 'array',
    ];

    // Relasi untuk mengambil nama pelanggan langsung
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi untuk mengambil detail layanan langsung
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}