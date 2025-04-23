<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_buku', 
        'tanggal_peminjaman', 
        'tanggal_pengembalian', 
        'status_peminjaman',
        'denda'
    ];

    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'tanggal_pengembalian' => 'date',
    ];

    // Accessor untuk menghitung denda
    public function getDendaAttribute($value)
    {
        if ($this->tanggal_pengembalian && $this->tanggal_pengembalian->gt($this->tanggal_peminjaman->addDays(7))) {
            $daysLate = $this->tanggal_pengembalian->diffInDays($this->tanggal_peminjaman->addDays(7));
            return $daysLate * 1000; // Misalnya, denda Rp. 1000 per hari
        }
        return 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class,'id_buku');
    }
}
