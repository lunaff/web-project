<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Menampilkan daftar kegiatan.
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('kegiatan.index', compact('kegiatan'));
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
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Foto
        $fotoPath = null;
        if ($request->hasFile('dokumentasi')) {
            $fotoPath = $request->file('dokumentasi')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'penyelenggara' => $request->penyelenggara,
            'dokumentasi' => $fotoPath,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail kegiatan.
     */
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
                'dokumentasi' => $kegiatan->dokumentasi,
            ];
        });
    
        // Kembalikan data dalam bentuk JSON
        return response()->json($data);
    }

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
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Foto
        if ($request->hasFile('dokumentasi')) {
            $fotoPath = $request->file('dokumentasi')->store('kegiatan', 'public');
            $kegiatan->dokumentasi = $fotoPath;
        }

        $kegiatan->update([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'penyelenggara' => $request->penyelenggara,
        ]);

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
