<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements WithHeadings
{
    /**
     * Mengambil data dari tabel siswa
     *
     * @return \Illuminate\Support\Collection
     */

    /**
     * Menentukan header untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'NIS', 
            'Active',
            'Kelas', 
            'Kompetensi Keahlian', 
            'Nama Lengkap', 
            'Tempat Lahir', 
            'Tanggal Lahir', 
            'Alamat', 
            'Agama', 
            'Kewarganegaraan', 
            'No. HP', 
            'Email', 
            'NISN', 
            'JK', 
            'Tahun Masuk', 
            'Nama Ayah', 
            'Nama Ibu', 
            'Alamat Ortu', 
            'No. Ortu', 
            'Nama Sekolah Asal', 
            'Alamat Sekolah', 
            'Tahun Lulus', 
            'Riwayat Penyakit', 
            'Prestasi Akademik', 
            'Prestasi Non Akademik', 
            'Ekstrakurikuler', 
        ];
    }
}
