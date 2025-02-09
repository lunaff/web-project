<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackRecord extends Model
{
    use HasFactory;

    protected $table = 'track_record';

    protected $fillable = [
        'siswa_id'
    ];

    // Relasi ke Siswa (Many-to-One)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    // Relasi ke Pelanggaran (Many-to-Many)
    public function pelanggaran()
    {
        return $this->belongsToMany(Pelanggaran::class, 'track_record_pelanggaran', 'track_record_id', 'pelanggaran_id');
    }

    // Relasi ke Laporan Kasus (Many-to-Many)
    public function laporanKasus()
    {
        return $this->belongsToMany(LaporanKasus::class, 'track_record_laporan_kasus', 'track_record_id', 'laporan_kasus_id');
    }
}
