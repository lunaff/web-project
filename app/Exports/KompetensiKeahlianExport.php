<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class KompetensiKeahlianExport implements  WithHeadings
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
            'Kompetensi Keahlian',
            'Kepala Kompetensi',
            'Tahun Ajaran',
        ];
    }
}
