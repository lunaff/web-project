<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';
    protected $fillable = [
        'tanggal',
        'jenis',
        'keterangan',
        'bukti',
        'sanksi'
    ];

    // Relasi many-to-many ke Siswa dengan pivot kolom siswa_nis
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'pelanggaran_siswa', 'pelanggaran_id', 'siswa_nis');
    }

}
