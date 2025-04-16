<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'ms_user';
    protected $primaryKey = 'idUser';
    public $timestamps = true;

    protected $fillable = ['namaUser', 'passwordUser', 'levelUser', 'statusUser'];

    protected $hidden = ['passwordUser'];

    public function getAuthPassword()
    {
        return $this->passwordUser; // Pastikan nama kolom sesuai
    }

    public function tokos()
    {
        return $this->hasMany(Toko::class, 'idUser');
    }
}
