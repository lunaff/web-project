<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DokumentasiPrestasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi_prestasi';

    protected $fillable = [
        'prestasi_id',
        'file',
    ];

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class);
    }
}
