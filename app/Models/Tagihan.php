<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihans';
    protected $fillable = ['id_tagihan', 'id_pelanggan', 'id_penggunaan', 'bulan', 'tahun', 'jumlah_meter', 'status' ,'total_bayar'];
    protected $primaryKey = 'id_tagihan';
    public $timestamps = false;
    public $incrementing = false;


    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }




    public function tagihan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_tagihan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_tagihan', 'id_tagihan');
    }
    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan', 'id_penggunaan');
    }
}
