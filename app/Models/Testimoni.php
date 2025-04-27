<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Tambahkan import ini

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'ms_testimoni'; 
    protected $primaryKey = 'idTestimoni';
    public $timestamps = true;

    protected $fillable = [
        'idUser',
        'gambarTestimoni',
        'tanggalTestimoni',
    ];
    
    // Accessor untuk memudahkan akses gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambarTestimoni && Storage::disk('public')->exists('testimoni/' . $this->gambarTestimoni)) {
            return asset('storage/testimoni/' . $this->gambarTestimoni);
        }
        
        return null;
    }
}