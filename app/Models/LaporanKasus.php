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
        'status',
        'dampingan_bk',
        'semester',
        'tahun_ajaran'
    ];

    protected $casts = [
        'dampingan_bk' => 'boolean',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id'); // Relasi ke model Siswa
    }

    public function pembinaan()
    {
        return $this->hasMany(Pembinaan::class, 'id_kasus', 'id');
    }
}
