<?php
namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\DokumentasiPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::all();

        if (Auth::user()->level == 'osis') {
            return view('prestasi.osis.index', compact('prestasi'));
        } else {
            return view('prestasi.index', compact('prestasi'));
        }
    }

    public function show(string $id)
    {
        //
        $prestasi = Prestasi::with('siswa')->get();

        $data = $prestasi->map(function ($prestasi) {
            return [
                'id' => $prestasi->id,
                'tanggal' => $prestasi->tanggal,
                'jenis' => $prestasi->jenis,
                'tingkat' => $prestasi->tingkat,
                'deskripsi' => $prestasi->deskripsi,
                'siswa_id' => $prestasi->siswa->nama_lengkap ?? '-',
                'tanggal_dokumentasi' => $prestasi->tanggal_dokumentasi,
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
            'tingkat' => 'required|in:Nasional,Provinsi,Internasional,Kabupaten/Kota',
            'deskripsi' => 'nullable|string',
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_dokumentasi' => 'nullable|date',
        ]);

        Prestasi::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'tingkat' => $request->tingkat,
            'deskripsi' => $request->deskripsi,
            'siswa_id' => $request->siswa_id,
            'tanggal_dokumentasi' => $request->tanggal_dokumentasi,
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $siswa = Siswa::all();
        return view('prestasi.edit', compact('prestasi', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:akademik,non-akademik',
            'tingkat' => 'required|in:Nasional,Provinsi,Internasional,Kabupaten/Kota',
            'deskripsi' => 'nullable|string',
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_dokumentasi' => 'nullable|date',
        ]);

        $prestasi = Prestasi::findOrFail($id); 

        $prestasi->update([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'tingkat' => $request->tingkat,
            'deskripsi' => $request->deskripsi,
            'siswa_id' => $request->siswa_id,
            'tanggal_dokumentasi' => $request->tanggal_dokumentasi,
        ]);

        $request->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->store('prestasi', 'public');

                DokumentasiPrestasi::create([
                    'kegiatan_id' => $prestasi->id,
                    'file' => $path,
                ]);
            }
        }     

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();
        return redirect()->route('prestasi.index')->with('success', 'Prestasi deleted successfully.');
    }
}
