<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasaBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_buku',
        'Rating',
        'Ulasan',
    ];

     // Relationship to User
     public function user()
     {
         return $this->belongsTo(User::class, 'id_user');
     }
 
     // Relationship to Buku
     public function buku()
     {
         return $this->belongsTo(Buku::class, 'id_buku');
     }
}
