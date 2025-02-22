<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'nis';
    public $incrementing = false;

    protected $table = 'siswa';
    protected $fillable = [
        'nama_lengkap',
        'nipd',
        'nis',
        'nisn',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'agama',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kode_pos',
        'jenis_tinggal',
        'alat_transportasi',
        'no_hp',
        'email',
        'penerima_kps',
        'no_kps',
        'kewarganegaraan',
        'nama_ayah',
        'tanggal_lahir_ayah',
        'jenjang_pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nik_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'jenjang_pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nik_ibu',
        'nama_wali',
        'tanggal_lahir_wali',
        'jenjang_pendidikan_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'nik_wali',
        'no_ortu',
        'no_peserta_un',
        'no_seri_ijazah',
        'penerima_kip',
        'nomor_kip',
        'nama_di_kip',
        'nomor_kks',
        'no_registrasi_akta_lahir',
        'bank',
        'nomor_rekening_bank',
        'rekening_atas_nama',
        'layak_pip',
        'alasan_layak_pip',
        'kebutuhan_khusus',
        'nama_sekolah_asal',
        'anak_keberapa',
        'lintang',
        'bujur',
        'no_kk',
        'berat_badan',
        'tinggi_badan',
        'jarak_rmh_sklh',
        'riwayat_penyakit',
        'alergi',
        'prestasi_akademik',
        'prestasi_non_akademik',
        'ekstrakurikuler',
        'biografi',
        'kdkelas',
        'kdkompetensi',
        'rombel_saat_ini',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_lahir_ayah' => 'date',
        'tanggal_lahir_ibu' => 'date',
        'tanggal_lahir_wali' => 'date',
        'lintang' => 'decimal:7',
        'bujur' => 'decimal:7',
        'penerima_kps' => 'boolean',
        'penerima_kip' => 'boolean',
        'layak_pip' => 'boolean',
    ];

    public function fkelas()
    {
        return $this->belongsTo(Kelas::class, 'kdkelas', 'id');
    }


    public function fkompetensi()
    {
        return $this->belongsTo(KompetensiKeahlian::class, 'kdkompetensi', 'id');
    }

    public function pelanggaran()
    {
        return $this->belongsToMany(Pelanggaran::class, 'pelanggaran_siswa', 'siswa_nis', 'pelanggaran_id');
    }

    public function laporanKasus()
    {
        return $this->hasMany(LaporanKasus::class, 'kdsiswa', 'id'); // Relasi ke model LaporanKasus
    }

    public function registrasi()
    {
        return $this->hasOne(RegistrasiSiswa::class, 'siswa_nis', 'nis');
    }
    
    public function mutasi()
    {
        return $this->hasOne(MutasiSiswa::class, 'siswa_nis', 'nis');
    }    
}
