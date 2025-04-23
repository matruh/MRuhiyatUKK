<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }

    // public function kategoris()
    // {
    //     return $this->belongsToMany(KategoriBuku::class, 'kategoribuku_relasis', 'id_buku', 'id_kategori');
    // }

    public function koleksiPribadi()
    {
        return $this->hasMany(KoleksiPribadi::class, 'id_buku');
    }

    public function ulasan()
    {
        return $this->hasMany(UlasaBuku::class, 'id_buku');
    }
}

