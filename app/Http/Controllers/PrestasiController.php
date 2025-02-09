<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::with('siswa')->get();
        return view('prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        $siswa = Siswa::all(); // Mengambil semua data siswa untuk dropdown
        return view('prestasi.create', compact('siswa'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:akademik,non-akademik',
            'deskripsi' => 'nullable|string',
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_dokumentasi' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'siswa_id' => $request->siswa_id,
            'tanggal_dokumentasi' => $request->tanggal_dokumentasi,
            'foto' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto) {
            $filePath = public_path('uploads/prestasi/' . $prestasi->foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $prestasi->delete();
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }

}
