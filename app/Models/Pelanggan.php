<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'nomor_kwh', 'nama_pelanggan', 'alamat', 'id_tarif', 'id_level'];

}

