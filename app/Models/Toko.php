<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'ms_toko';
    protected $primaryKey = 'idToko';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'namaToko',
        'alamatToko',
        'idUser',
    ];

    // Relasi ke ms_user
    public function user()
    {
        return $this->belongsTo(MsUser::class, 'idUser', 'idUser');
    }
}
