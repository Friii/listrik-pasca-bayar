<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $fillable = ['id_user','username', 'password', 'nama_admin', 'id_level'];

    public function pelanggan()
    {
        // User ini memiliki satu data Pelanggan.
        // Laravel akan mencari di tabel 'pelanggans' yang 'user_id'-nya
        // sama dengan 'id' dari user ini.
        return $this->hasOne(Pelanggan::class, 'user_id');
    }
}
