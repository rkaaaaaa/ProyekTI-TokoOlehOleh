<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsUser extends Model
{
    use HasFactory;

    protected $table = 'ms_user';
    protected $primaryKey = 'idUser';
    public $timestamps = true;

    protected $fillable = ['namaUser', 'passwordUser', 'levelUser', 'statusUser'];

    protected $hidden = ['passwordUser'];
}
