<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Imports\GuruImport;
use App\Exports\GuruExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    //
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        return back()->with('success', 'Data guru berhasil diimport!');
    }

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
        return redirect()->route('guru.index')->with('success', 'Berhasil menambah Guru baru');
    }

    public function edit($id)
    {
        $guru = Guru::find($id);
        if (!$guru) return redirect()->route('guru.index')->with('error_message', 'Guru dengan NIP = ' . $id . ' tidak ditemukan');
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return redirect()->route('guru.index')->with('error_message', 'Guru dengan NIP = ' . $id . ' tidak ditemukan');
        }

        $request->validate([
            'nip' => 'required|unique:guru,nip,' . $id,
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
            'tempat_lahir',
            'tanggal_lahir'
        ]);

        $guru->update($array);
        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Berhasil mengubah Guru');
    }

    public function destroy($id)
    {
        // Find the guru by ID
        $guru = Guru::find($id);
    
        // Check if the guru exists
        if (!$guru) {
            return redirect()->route('guru.index')
                ->with('error_message', 'Guru with NIP ' . $id . ' not found.');
        }
    
        // Delete the guru
        $guru->delete();
    
        // Redirect to the guru index page with a success message
        return redirect()->route('guru.index')
            ->with('success', 'Guru deleted successfully.');
    }
    public function exportGuru()
    {
        return Excel::download(new GuruExport, 'data_guru.xlsx');
    }

}
