<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKasus extends Model
{
    use HasFactory;

    protected $table = 'laporan_kasus';

    protected $fillable = [
        'kdsiswa',
        'tanggal',
        'kasus',
        'bukti',
        'tindak_lanjut',
        'status_kasus',
        'dampingan_bk',
        'semester',
        'tahun_ajaran'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'dampingan_bk' => 'boolean',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }
}
