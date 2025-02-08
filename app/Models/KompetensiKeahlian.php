<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KompetensiKeahlian extends Model
{
    //
    use HasFactory;

    protected $table = 'kompetensi_keahlian';
    protected $fillable = [
        'id',
        'kompetensi_keahlian',
        'guru_nip',
        'tahun_ajaran' // Tambahkan 'guru_nip' ke fillable
    ];

    public function fguru()
    {
        return $this->belongsTo(Guru::class, 'guru_nip');
    }
}
