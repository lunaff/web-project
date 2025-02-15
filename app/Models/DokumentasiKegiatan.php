<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumentasiKegiatan extends Model
{
    //
    use HasFactory;

    protected $table = 'dokumentasi_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'file', // Kolom lain yang ada pada tabel dokumentasi
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
