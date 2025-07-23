<?php

namespace App\Models;

// 1. Ganti 'use Illuminate\Database\Eloquent\Model;' dengan ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Opsional, tapi baik untuk ada

// 2. Ganti 'class Pelanggan extends Model' menjadi 'extends Authenticatable'
class Pelanggan extends Authenticatable
{
    use Notifiable; // Tambahkan ini

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_pelanggan', 'username', 'password', 'nomor_kwh', 'nama_pelanggan', 'alamat', 'id_tarif', 'id_level'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }

    // Relasi lain bisa ditambahkan di sini jika perlu
    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_pelanggan');
    }
    




}


 