<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\DokumentasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Menampilkan daftar kegiatan.
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();

        if (Auth::user()->level == 'osis') {
            return view('kegiatan.osis.index', compact('kegiatan'));
        } else {
            return view('kegiatan.index', compact('kegiatan'));
        }
    }
    
    public function show(string $id)
    {
        //
        $kegiatan = Kegiatan::all();

        $data = $kegiatan->map(function ($kegiatan) {
            return [
                'id' => $kegiatan->id,
                'tanggal' => $kegiatan->tanggal,
                'nama' => $kegiatan->nama,
                'penyelenggara' => $kegiatan->penyelenggara,
                // 'dokumentasi' => $kegiatan->dokumentasi->file,
            ];
        });
    
        // Kembalikan data dalam bentuk JSON
        return response()->json($data);
    }


    /**
     * Menampilkan form tambah kegiatan.
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Menyimpan data kegiatan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
        ]);

        Kegiatan::create([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'penyelenggara' => $request->penyelenggara,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail kegiatan.
     */

    /**
     * Menampilkan form edit kegiatan.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Memperbarui data kegiatan.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $kegiatan->update([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'penyelenggara' => $request->penyelenggara,
        ]);

        $request->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Validasi untuk banyak file
        ]);
    
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->store('kegiatan', 'public');

                DokumentasiKegiatan::create([
                    'kegiatan_id' => $kegiatan->id,
                    'file' => $path,
                ]);
            }
        }        

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    /**
     * Menghapus kegiatan.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
