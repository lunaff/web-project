<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'level' => $row['level'],
            'guru_nip' => $row['nip'],
            'siswa_nis' => $row['nis'],
        ]);
    }
}
