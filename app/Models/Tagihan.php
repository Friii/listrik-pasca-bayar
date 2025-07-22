<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihans';
    protected $fillable = ['id_tagihan', 'id_pelanggan', 'id_penggunaan', 'bulan', 'tahun', 'jumlah_meter', 'status'];
    protected $primaryKey = 'id_tagihan';
    public $timestamps = false;
    public $incrementing = false;


    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function penggunaan()
{
    return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
}


    public function tagihan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_tagihan');
    }
}
