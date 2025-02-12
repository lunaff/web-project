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

    // Jika nama di database adalah 'status', tetapi di model 'status_kasus'
    protected $attributes = [
        'status_kasus' => 'status', // Mapping ke kolom di database
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id'); // Relasi ke model Siswa
    }
}
