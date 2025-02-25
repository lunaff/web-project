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
        try {
            // Validasi data yang diperlukan
            if (empty($row['NIS']) || empty($row['Nama_Lengkap']) || empty($row['JK'])) {
                throw new \Exception("Data NIS, Nama_Lengkap, atau JK tidak boleh kosong.");
            }

            $namaKompetensi = $row['Kompetensi_Keahlian'] ?? null;
            $kompetensi = KompetensiKeahlian::where('kompetensi_keahlian', $namaKompetensi)->first();

            if (!$kompetensi) {
                throw new \Exception("Kompetensi '{$namaKompetensi}' tidak ditemukan.");
            }

            $namaKelas = $row['Kelas'] ?? null;
            $kelas = Kelas::where('kelas', $namaKelas)->first();

            if (!$kelas) {
                throw new \Exception("Kelas '{$namaKelas}' tidak ditemukan.");
            }

            // Lanjutkan dengan membuat model Siswa
            return new Siswa([
                'nis'                    => $row['NIS'] ?? '',
                'active'                 => isset($row['Active']) ? filter_var($row['Active'], FILTER_VALIDATE_BOOLEAN) : true,
                'kdkelas'                => $kelas->id ?? null,
                'kdkompetensi'           => $kompetensi->id ?? null,
                'nama_lengkap'           => $row['Nama_Lengkap'] ?? '',
                'nipd'                   => $row['NIPD'] ?? '',
                'jk'                     => $this->getValidGender($row['JK'] ?? null),
                'nisn'                   => $row['NISN'] ?? '',
                'tempat_lahir'           => $row['Tempat_Lahir'] ?? '',
                'tanggal_lahir'          => $this->convertToDate($row['Tanggal_Lahir'] ?? null),
                'nik'                    => $row['NIS'] ?? '',
                'agama'                  => !empty($row['Agama']) ? trim($row['Agama']) ?? '' : 'Islam',
                'alamat'                 => $row['Alamat'] ?? '',
                'no_hp'                  => $row['No_HP'] ?? '',
                'email'                  => $row['Email'] ?? '',
                'penerima_kps'           => !empty($row['Penerima_KPS']) ? (int) $row['Penerima_KPS'] : 0,
                'no_kps'                 => $row['No_KPS'] ?? '',
                'kewarganegaraan'        => in_array($row['Kewarganegaraan'] ?? '', ['WNI', 'WNA']) ? $row['Kewarganegaraan'] : 'WNI',
                'no_ortu'                => $row['No_Orang_Tua/Wali'] ?? '',
                'nama_sekolah_asal'      => $row['Nama_Sekolah_Asal'] ?? '',
            ]);

        } catch (\Exception $e) {
            \Log::error("Error di baris: " . json_encode($row) . " - " . $e->getMessage());

            // Simpan error dalam session agar bisa ditampilkan di UI
            session()->push('import_errors', [
                'row' => json_encode($row, JSON_PRETTY_PRINT),
                'message' => $e->getMessage(),
            ]);

            return null; // Lanjutkan ke data berikutnya
        }
    }
        
    /**
     * Convert date to a valid format if necessary
     */
    private function convertToDate($date)
    {
        if (empty($date)) {
            return null;
        }

        // Jika tanggal adalah format Excel serial date
        if (is_numeric($date)) {
            try {
                $unixDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
                return $unixDate->format('Y-m-d');
            }catch (\Exception $e) {
                return null;
            }
            
        }

        // Jika tanggal adalah string, coba parsing ke format Y-m-d
        try {
            $parsedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date);
            return $parsedDate->format('Y-m-d');
        }catch (\Exception $e) {
            \Log::error("Error parsing date: " . $e->getMessage());
            return null;
        }
        
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

