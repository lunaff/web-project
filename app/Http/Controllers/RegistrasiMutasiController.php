<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\RegistrasiSiswa;
use App\Models\MutasiSiswa;

class RegistrasiMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('siswa.registrasi-mutasi.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registrasi(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_nis' => 'required|string|exists:siswa,nis',
            'jenis_pendaftaran' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'no_ijazah' => 'nullable|string',
        ]);
    
        $siswa = Siswa::where('nis', $validatedData['siswa_nis'])->first();
        if (!$siswa) {
            return redirect()->route('siswa.registrasi.mutasi')->withErrors(['siswa_nis' => 'Siswa tidak ditemukan']);
        }
    
        $registrasi = $siswa->registrasi()->updateOrCreate(
            ['siswa_nis' => $validatedData['siswa_nis']],
            [
                'jenis_pendaftaran' => $validatedData['jenis_pendaftaran'],
                'tanggal_masuk' => $validatedData['tanggal_masuk'],
                'no_ijazah' => $validatedData['no_ijazah'],
            ]
        );    

        if ($registrasi->wasRecentlyCreated) {
            $siswa->update(['active' => 1]);
        }
    
        return redirect()->route('siswa.registrasi.mutasi')->with('success', 'Registrasi berhasil!');
    }    

    public function mutasi(Request $request)
    {
        //
        $validatedData = $request->validate([
            'siswa_nis' => 'required|string|exists:siswa,nis',
            'alasan' => 'required|string',
            'tanggal_keluar' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    
        $siswa = Siswa::where('nis', $validatedData['siswa_nis'])->first();
        if (!$siswa) {
            return redirect()->route('siswa.registrasi.mutasi')->withErrors(['siswa_nis' => 'Siswa tidak ditemukan']);
        }
    
        $siswa->mutasi()->updateOrCreate(
            ['siswa_nis' => $validatedData['siswa_nis']],
            [
                'alasan' => $validatedData['alasan'],
                'tanggal_keluar' => $validatedData['tanggal_keluar'],
                'notes' => $validatedData['notes'],
            ]
        );

        $siswa->update(['active' => 0]);
    
        return redirect()->route('siswa.registrasi.mutasi')->with('success', 'Mutasi berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
