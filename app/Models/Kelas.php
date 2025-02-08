<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    //
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'id',
        'kelas',
        'guru_nip',
        'kdkompetensi',
        'tahun_ajaran',
    ];

    public function fguru()
    {
        return $this->belongsTo(Guru::class, 'guru_nip');
    }

    public function fkompetensi()
    {
        return $this->belongsTo(KompetensiKeahlian::class, 'kdkompetensi');
    }
}
