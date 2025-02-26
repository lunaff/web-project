<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['name'])) {
            Log::warning('Skipped row due to missing name', ['row' => $row]);
            return null;
        }

        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'level' => $row['level'],
            'guru_nip' => $row['nip'],
            'siswa_nis' => $row['nis'],
        ]);
    }
}
