<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    /**
     * Add headings to the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Password',
            'Level',
            'NIP',
            'NIS',
        ];
    }
}
