<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\KompetensiKeahlian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class KelasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari kode kompetensi berdasarkan nama
        $nama = $row['kompetensi_keahlian'];
        $kompetensi = KompetensiKeahlian::where('kompetensi_keahlian', $nama)->first();

        if (!$kompetensi) {
            throw ValidationException::withMessages([
                'kompetensi_keahlian' => "Kompetensi '{$nama}' tidak ditemukan di database.",
            ]);
        }
        
        return new Kelas([
            'kelas'         => $row['kelas'] ?? '',
            'guru_nip'      => $row['nip_wali_kelas'] ?? '',
            'kdkompetensi'  => $kompetensi->id, // Simpan kode kompetensi
            'tahun_ajaran'  => $row['tahun_ajaran'] ?? '',
        ]);
    }
}

