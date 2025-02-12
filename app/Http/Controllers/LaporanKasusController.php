<?php

namespace App\Http\Controllers;

use App\Models\LaporanKasus;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LaporanKasusController extends Controller
{
    // Menampilkan daftar laporan kasus
    public function index()
    {
        $laporanKasus = LaporanKasus::with('siswa')->get(); // Ambil data laporan kasus beserta relasi siswa
        return view('laporan-kasus.index', compact('laporanKasus')); // Kirim data ke view
    }

    // Menampilkan form untuk membuat laporan kasus baru
    public function create()
    {
        $siswa = Siswa::with(['fkelas', 'fkompetensi'])->get(); // Load relasi fkelas dan fkompetensi
        return view('laporan-kasus.create', compact('siswa'));
    }

    // Menyimpan laporan kasus baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kdsiswa' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'kasus' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,mp4',
            'tindak_lanjut' => 'required|string',
            'status' => 'required|in:penanganan_walas,penanganan_kesiswaan,selesai',
            'dampingan_bk' => 'required|boolean',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        LaporanKasus::create($data);

        return redirect()->route('laporan-kasus.index')->with('success', 'Laporan kasus berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit laporan kasus
    public function edit(LaporanKasus $laporanKasus)
    {
        $siswa = Siswa::with(['fkelas', 'fkompetensi'])->get(); // Load relasi fkelas dan fkompetensi
        return view('laporan-kasus.edit', compact('laporanKasus', 'siswa'));
    }

    // Menyimpan perubahan laporan kasus ke database
    public function update(Request $request, LaporanKasus $laporanKasus)
    {
        $request->validate([
            'kdsiswa' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'kasus' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,mp4',
            'tindak_lanjut' => 'required|string',
            'status' => 'required|in:penanganan_walas,penanganan_kesiswaan,selesai',
            'dampingan_bk' => 'required|boolean',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti')) {
            if ($laporanKasus->bukti) {
                Storage::disk('public')->delete($laporanKasus->bukti);
            }
            $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        $laporanKasus->update($data);

        return redirect()->route('laporan-kasus.index')->with('success', 'Laporan kasus berhasil diperbarui.');
    }

    // Menghapus laporan kasus
    public function destroy(LaporanKasus $laporanKasus)
    {
        if ($laporanKasus->bukti) {
            Storage::disk('public')->delete($laporanKasus->bukti);
        }

        $laporanKasus->delete();

        return redirect()->route('laporan-kasus.index')->with('success', 'Laporan kasus berhasil dihapus.');
    }

    // Mengambil data laporan kasus untuk GridJS
    public function show()
    {
        $laporanKasus = LaporanKasus::with('siswa')->get();

        $data = $laporanKasus->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                // 'id' => $item->id,
                'tanggal' => Carbon::parse($item->tanggal)->format('d-m-Y'),
                'nama_siswa' => $item->siswa->nama_lengkap,
                'kasus' => $item->kasus,
                'bukti' => $item->bukti,
                'tindak_lanjut' => $item->tindak_lanjut,
                'status' => $item->status_kasus, // Gunakan nama di model
                'dampingan_bk' => $item->dampingan_bk,
                'semester' => $item->semester,
                'tahun_ajaran' => $item->tahun_ajaran,
            ];
        });

        return response()->json($data);
    }
}
