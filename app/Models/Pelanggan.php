<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $fillable = ['username', 'nomor_kwh','nama_pelanggan', 'alamat'];
}

