<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $table = 'penggunaans'; // pastikan nama tabel benar

    protected $fillable = [
        'id_pelanggan',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
    ];

    // ✅ Tambahkan relasi ini:
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
