<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'kategori',
        'jenis',
        'harga',
        'lokasi',
        'user_id',
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
