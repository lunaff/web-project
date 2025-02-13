<?php

namespace App\Imports;

use App\Models\KompetensiKeahlian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KompetensiKeahlianImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KompetensiKeahlian([
            'kompetensi_keahlian'         => $row['kompetensi_keahlian'],
            'guru_nip'      => $row['kepala_kompetensi'],
            'tahun_ajaran'  => $row['tahun_ajaran'],
        ]);
    }
}
