<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $fillable = ['peminjaman_id', 'buku_id'];
    public $timestamps = false;

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
