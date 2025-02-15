<?php

namespace App\Http\Controllers\Dokumentasi;

use App\Models\Prestasi;
use App\Models\DokumentasiPrestasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DokumentasiPrestasiController extends Controller
{
    public function index($prestasi_id)
    {
        $prestasi = Prestasi::find($prestasi_id);
        return view('prestasi.dokumentasi', compact('prestasi'));
    }

    public function create($prestasi_id)
    {
        //
        $prestasi = Prestasi::findOrFail($prestasi_id);
        return view('prestasi.osis.form', compact('prestasi'));
    }

    public function store(Request $request, $prestasi_id)
    {
        //
        $request->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->store('prestasi', 'public');
                DokumentasiPrestasi::create([
                    'prestasi_id' => $prestasi_id,
                    'file' => $path,
                ]);
            }
        }
    
        return redirect()->route('prestasi.index', $prestasi_id)->with('success', 'Dokumentasi berhasil diupload!');
    }
    
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
