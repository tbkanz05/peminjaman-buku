<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['user_id', 'tanggal_pinjam', 'status', 'tanggal_kembali', 'jatuh_tempo', 'denda'];
    
    public function calculateDenda()
    {
        if ($this->status == 'kembali') {
            return $this->denda;
        }

        $jatuh_tempo = \Carbon\Carbon::parse($this->jatuh_tempo)->startOfDay();
        $hari_ini = now()->startOfDay();

        if ($hari_ini->gt($jatuh_tempo)) {
            $selisih = $hari_ini->diffInDays($jatuh_tempo);
            return $selisih * 2000;
        }

        return 0;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasOne(DetailPeminjaman::class);
    }
}
