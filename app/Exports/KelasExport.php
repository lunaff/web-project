<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasExport implements WithHeadings
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
            'Kelas',
            'Wali Kelas',
            'Kompetensi Keahlian',
            'Tahun Ajaran',
        ];
    }
}
