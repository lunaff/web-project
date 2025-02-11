<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'name', // Jika ada kolom 'name'
        'email',
        'password',
        'level',
        'guru_nip', // Tambahkan 'guru_nip' ke fillable
        'siswa_nis', // Tambahkan 'level' jika ada
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Pastikan password di-hash
    ];


    public function fguru()
    {
        return $this->belongsTo(Guru::class, 'guru_nip', 'nip');
    }

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nis', 'nis');
    }
}