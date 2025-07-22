<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_pelanggan','username', 'password', 'nomor_kwh', 'nama_pelanggan', 'alamat', 'id_tarif', 'id_level'];

    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_pelanggan');
    }
    public function tarif()
{
    return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
}

    
}


