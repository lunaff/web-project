<?php

namespace App\Http\Controllers;
use App\Models\Guru;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    //
    public function show()
    {
        $gurus = Guru::all()->map(function ($guru) {
            // Ganti semua field yang null menjadi '-'
            foreach ($guru->getAttributes() as $key => $value) {
                // Cek untuk field 'JK' dan ubah 'P' menjadi 'Perempuan' dan 'L' menjadi 'Laki-laki'
                if ($key == 'jk') {
                    $guru->{$key} = $value == 'P' ? 'Perempuan' : ($value == 'L' ? 'Laki-laki' : '-');
                }
                // Jika nilai null, ganti dengan '-'
                else {
                    $guru->{$key} = $value ?? '-';
                }
            }
            return $guru;
        });  
        // Return data as JSON for the Grid.js table
        return response()->json($gurus);
    }

    public function index()
    {
        return view('guru.index'); // Pastikan view ada di resources/views/dashboard/dashboard.blade.php
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama_guru' => 'required',
            'notelp' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);
        $array = $request->only([
            'nip',
            'nama_guru',
            'notelp',
            'jk',
            'alamat',
            'agama',
            'tempat_lahir',
            'tanggal_lahir'

        ]);
        $guru = Guru::create($array);
        return redirect()->route('guru.index')->with('success_message', 'Berhasil menambah Guru baru');
    }

}
