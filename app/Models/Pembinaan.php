<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    use HasFactory;

    protected $table = 'pembinaan';
    
    protected $fillable = [
        'id_kasus',
        'id_guru',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'status',
        'note'
    ];

    public function kasus()
    {
        return $this->belongsTo(LaporanKasus::class, 'id_kasus', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function hitungDurasi()
    {
        if ($this->tanggal_selesai) {
            return \Carbon\Carbon::parse($this->tanggal_mulai)->diffInDays($this->tanggal_selesai);
        }
        return null;
    }
}
