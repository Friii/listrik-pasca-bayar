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

}

