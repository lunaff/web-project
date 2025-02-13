<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class GuruImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Guru([
            //
            'nip' => $row['nip'],
            'nama_guru' => $row['nama'],
            'notelp' => $row['no_telp'],
            'jk' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'],
            'agama' => $row['agama'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $this->formatTanggal($row['tanggal_lahir']),
        ]);
    }
    /**
     * Konversi format tanggal ke yyyy-mm-dd
     */
    private function formatTanggal($tanggal)
    {
        if (!$tanggal) {
            return null;
        }
    
        try {
            // Jika format tanggal adalah angka (Excel menyimpan tanggal sebagai angka)
            if (is_numeric($tanggal)) {
                return Carbon::createFromTimestamp(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($tanggal))
                    ->format('Y-m-d');
            }
    
            // Jika format tanggal adalah teks biasa (dd/mm/yyyy atau lainnya)
            return Carbon::parse($tanggal)->format('Y-m-d');
    
        } catch (\Exception $e) {
            return null; // Jika gagal parse, kembalikan null
        }
    }
    
}
