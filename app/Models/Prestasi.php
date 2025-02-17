<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'tanggal',
        'jenis',
        'tingkat',
        'deskripsi',
        'siswa_id',
        'tanggal_dokumentasi',
    ];

    // Relasi ke tabel siswa (Setiap prestasi dimiliki oleh satu siswa)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function dokumentasi()
    {
        return $this->hasMany(DokumentasiPrestasi::class);
    }
}
