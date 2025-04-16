<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'ms_testimoni'; // disesuaikan dengan nama tabel
    protected $primaryKey = 'idTestimoni';
    public $timestamps = true;

    protected $fillable = [
        'idUser',
        'gambarTestimoni',
        'tanggalTestimoni',
    ];
}
