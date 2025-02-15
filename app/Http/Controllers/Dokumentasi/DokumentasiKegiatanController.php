<?php

namespace App\Http\Controllers\Dokumentasi;

use App\Models\Kegiatan;
use App\Models\DokumentasiKegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokumentasiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kegiatan_id)
    {
        //
        $kegiatan = Kegiatan::find($kegiatan_id);
        return view('kegiatan.dokumentasi', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kegiatan_id)
    {
        //
        $kegiatan = Kegiatan::findOrFail($kegiatan_id);
        return view('kegiatan.osis.form', compact('kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kegiatan_id)
    {
        //
        $request->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Validasi untuk banyak file
        ]);
    
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->store('kegiatan', 'public'); // Simpan ke storage/app/public/kegiatan
                
                // Simpan ke database
                DokumentasiKegiatan::create([
                    'kegiatan_id' => $kegiatan_id,
                    'file' => $path,
                ]);
            }
        }
    
        return redirect()->route('osis-kegiatan.index', $kegiatan_id)->with('success', 'Dokumentasi berhasil diupload!');
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
