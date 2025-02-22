<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrasiSiswa extends Model
{
    //
    use HasFactory;

    protected $table = 'registrasi_siswa';

    protected $fillable = [
        'siswa_nis',
        'jenis_pendaftaran',
        'tanggal_masuk',
        'no_ijazah'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nis', 'nis');
    }
}
