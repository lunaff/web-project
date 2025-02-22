<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MutasiSiswa extends Model
{
    //
    use HasFactory;

    protected $table = 'mutasi_siswa';

    protected $fillable = [
        'siswa_nis',
        'alasan',
        'tanggal_keluar',
        'notes',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nis', 'nis');
    }
}
