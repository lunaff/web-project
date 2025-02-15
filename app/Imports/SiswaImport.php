<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            //
            'nis' => $row['nis'],
            // 'kdkelas',
            // 'kdkompetensi',
            'nama_lengkap' => $row['nama_lengkap'],
            'tempat_lahir' => $row['tempat_lahir'],
            // 'tanggal_lahir' => $this->formatTanggal($row['tanggal_lahir']),
            'alamat' => $row['alamat'],
            'agama' => $row['agama'],
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
        ]);
    }
}
