<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganRumah extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_rumah';

    protected $fillable = [
        'idKasus',
        'tanggal',
        'solusi',
        'surat',
        'dokumentasi',
    ];

    public function laporanKasus()
    {
        return $this->belongsTo(LaporanKasus::class, 'idKasus', 'id');
    }
}
