<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    //
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'kdkelas',
        'kdkompetensi',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'kewarganegaraan',
        'no_hp',
        'email',
        'nisn',
        'tahun_masuk',
        'nama_ayah',
        'nama_ibu',
        'alamat_ortu',
        'no_ortu',
        'nama_sekolah_asal',
        'alamat_sekolah',
        'tahun_lulus',
        'riwayat_penyakit',
        'alergi',
        'prestasi_akademik',
        'prestasi_non_akademik',
        'ekstrakurikuler',
        'biografi'
    ];

    public function fkelas()
    {
        return $this->belongsTo(Kelas::class, 'kdkelas', 'id');
    }


    public function fkompetensi()
    {
        return $this->belongsTo(KompetensiKeahlian::class, 'kdkompetensi', 'id');
    }
}
