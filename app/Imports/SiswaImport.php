<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\KompetensiKeahlian;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\ValidationException;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws ValidationException
     */
    public function model(array $row)
    {
        $namaKompetensi = $row['kompetensi_keahlian'];
        $kompetensi = KompetensiKeahlian::where('kompetensi_keahlian', $namaKompetensi)->first();

        if (!$kompetensi) {
            throw ValidationException::withMessages([
                'kompetensi_keahlian' => "Kompetensi '{$namaKompetensi}' tidak ditemukan di database.",
            ]);
        }

        $namaKelas = $row['kelas'];
        $kelas = Kelas::where('kelas', $namaKelas)->first();



        if (!$kelas) {
            throw ValidationException::withMessages([
                'kelas' => "Tidak ditemukan kelas untuk kompetensi '{$namaKelas}'.",
            ]);
        }

        return new Siswa([
            'nis'                    => $row['nis'] ?? '',
            'active'                 => true, 
            'kdkelas'                => $kelas->kelas ?? null,  // Ambil kode kelas dari model Kelas
            'kdkompetensi'           => $kompetensi->kompetensi_keahlian ?? null,  // Ambil kode kompetensi dari model
            'nama_lengkap'           => $row['nama_lengkap'] ?? '',
            'tempat_lahir'           => $row['tempat_lahir'] ?? '',
            'tanggal_lahir'          => $this->convertToDate($row['tanggal_lahir'] ?? null),
            'alamat'                 => $row['alamat'] ?? '',
            'agama'                  => $row['agama'] ?? '',
            'kewarganegaraan'        => $row['kewarganegaraan'] ?? '',  
            'no_hp'                  => $row['no_hp'] ?? '',
            'email'                  => $row['email'] ?? '',
            'nisn'                   => $row['nisn'] ?? '',
            'jk'                     => $this->getValidGender($row['jk'] ?? null), 
            'tahun_masuk'            => $row['tahun_masuk'] ?? '',
            'nama_ayah'              => $row['nama_ayah'] ?? '',
            'nama_ibu'               => $row['nama_ibu'] ?? '',
            'alamat_ortu'            => $row['alamat_ortu'] ?? '',
            'no_ortu'                => $row['no_ortu'] ?? '',
            'nama_sekolah_asal'      => $row['nama_sekolah_asal'] ?? '',
            'alamat_sekolah'         => $row['alamat_sekolah'] ?? '',
            'tahun_lulus'            => $row['tahun_lulus'] ?? '',
            'riwayat_penyakit'       => $row['riwayat_penyakit'] ?? null, 
            'alergi'                 => $row['alergi'] ?? null, 
            'prestasi_akademik'      => $row['prestasi_akademik'] ?? null, 
            'prestasi_non_akademik'  => $row['prestasi_non_akademik'] ?? null, 
            'ekstrakurikuler'        => $row['ekstrakurikuler'] ?? null, 
            'biografi'               => $row['biografi'] ?? null, 
        ]);
    }

    /**
     * Convert date to a valid format if necessary
     */
    private function convertToDate($date)
    {
        if (empty($date)) {
            return null;
        }

        // Convert if it's an Excel serial date format
        if (is_numeric($date)) {
            $unixDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
            return $unixDate->format('Y-m-d');
        }

        // Validate date format
        if (strtotime($date)) {
            return date('Y-m-d', strtotime($date));
        }

        return null; // Invalid date
    }

    /**
     * Ensure gender is valid (L or P), default to 'L' if invalid
     */
    private function getValidGender($gender)
    {
        $gender = strtoupper(trim($gender)); // Normalize input
        return in_array($gender, ['L', 'P']) ? $gender : 'L';
    }
}
