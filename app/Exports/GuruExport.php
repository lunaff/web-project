<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /**
     * Set the headings for the Excel sheet
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'No. Telp',
            'Jenis Kelamin',
            'Alamat',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
        ];
    }
}
