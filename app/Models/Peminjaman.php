<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['user_id', 'tanggal_pinjam', 'status', 'tanggal_kembali', 'denda'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasOne(DetailPeminjaman::class);
    }
}
