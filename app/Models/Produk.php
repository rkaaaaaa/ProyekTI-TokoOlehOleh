<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'ms_produk';
    protected $primaryKey = 'idProduk';
    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'namaProduk',
        'hargaProduk',
        'gambarProduk',
        'deskripsiProduk',
        'kategoriProduk'
    ];
}

