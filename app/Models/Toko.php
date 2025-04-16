<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    public $timestamps = false; 

    protected $table = 'ms_toko';
    protected $primaryKey = 'idToko';
    public $incrementing = true;
    protected $fillable = ['namaToko', 'alamatToko', 'idUser'];


    // Relasi ke model User
    public function user()
    {
         return $this->belongsTo(MsUser::class, 'idUser', 'idUser');
    }
}

