<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'nip'; // Tentukan 'nip' sebagai primary key
    public $incrementing = false; // Karena 'nip' adalah string, atur incrementing ke false
    
    protected $table = 'guru';
    protected $fillable = [
        'nip',
        'nama_guru',
        'notelp',
        'jk',
        'alamat',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
    ];

    public function fkompetensi()
    {
        return $this->hasOne(KompetensiKeahlian::class, 'guru_nip');
    }

    public function fkelas()
    {
        return $this->hasOne(Kelas::class, 'guru_nip');
    }
}
