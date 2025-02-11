<?php
namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        return view('prestasi.index');
    }

    public function show(string $id)
    {
        //
        $prestasi = Prestasi::with(['siswa'])->get();

        $data = $prestasi->map(function ($prestasi) {
            return [
                'id' => $prestasi->id,
                'tanggal' => $prestasi->tanggal,
                'jenis' => $prestasi->jenis,
                'deskripsi' => $prestasi->deskripsi,
                'siswa_id' => $prestasi->siswa ?  $prestasi->siswa->nama_lengkap : '-',
                'tanggal_dokumentasi' => $prestasi->tanggal_dokumentasi,
                'foto' => $prestasi->foto,
            ];
        });
    
        // Kembalikan data dalam bentuk JSON
        return response()->json($data);
    }


    public function create()
    {
        $siswa = Siswa::all();
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

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto) {
            Storage::delete('public/' . $prestasi->foto);
        }

        $prestasi->delete();
        return response()->json(['success' => true, 'message' => 'Prestasi berhasil dihapus.']);
    }
}
