<?php

namespace App\Http\Controllers;

use App\Models\LaporanKasus;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LaporanKasusController extends Controller
{
    // Menampilkan daftar laporan kasus
    public function index()
    {
        return view('laporan-kasus.index');
    }

    // Menampilkan form untuk membuat laporan kasus baru
    public function create()
    {
        $siswa = Siswa::with(['fkelas', 'fkompetensi'])->get();
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
        'status_kasus' => 'required|in:penanganan_walas,penanganan_kesiswaan,selesai', // Validasi pakai status_kasus
        'dampingan_bk' => 'required|boolean',
        'semester' => 'required|in:Ganjil,Genap',
        'tahun_ajaran' => 'required|string',
    ]);

    // Mapping `status_kasus` ke `status`
    $data = $request->all();
    $data['status'] = $data['status_kasus']; // Sesuaikan dengan field di database
    unset($data['status_kasus']); // Hapus key `status_kasus` agar tidak ada data berlebih

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        LaporanKasus::create($data);

    return redirect()->route('laporan-kasus.index')->with('success', 'Laporan kasus berhasil ditambahkan.');
}

    // Menampilkan form untuk mengedit laporan kasus
    public function edit(LaporanKasus $laporanKasus)
{
    $siswa = Siswa::with(['fkelas', 'fkompetensi'])->get();
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
        'hapus_bukti' => 'nullable|boolean',
        'tindak_lanjut' => 'required|string',
        'status' => 'required|in:penanganan_walas,penanganan_kesiswaan,selesai',
        'dampingan_bk' => 'required|boolean',
        'semester' => 'required|in:Ganjil,Genap',
        'tahun_ajaran' => 'required|string',
    ]);

    $data = $request->all();

    // Hapus bukti jika checkbox dicentang
    if ($request->has('hapus_bukti')) {
        if ($laporanKasus->bukti) {
            Storage::disk('public')->delete($laporanKasus->bukti);
            $data['bukti'] = null;
        }
    }

    // Jika ada file bukti baru, simpan
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
    public function destroy($id)
    {
        $laporanKasus = LaporanKasus::findOrFail($id);

        if ($laporanKasus->bukti) {
            Storage::disk('public')->delete($laporanKasus->bukti);
        }

        $laporanKasus->delete();

        return redirect()->route('laporan-kasus.index')->with('success', 'Laporan kasus berhasil dihapus.');
    }

    // Mengambil data laporan kasus untuk GridJS
    public function show()
    {
        if (Auth::user()->level == 'bk') {
            $laporanKasus = LaporanKasus::where('dampingan_bk', true)->with('siswa')->get();
        }
        else {
            $laporanKasus = LaporanKasus::with('siswa')->get();
        }

        $data = $laporanKasus->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'tanggal' => Carbon::parse($item->tanggal)->format('d-m-Y'),
                'nama_siswa' => $item->siswa->nama_lengkap ?? 'Tidak Diketahui',
                'kasus' => $item->kasus,
                'bukti' => $item->bukti,
                'tindak_lanjut' => $item->tindak_lanjut,
                'dampingan_bk' => $item->dampingan_bk,
                'semester' => $item->semester,
                'tahun_ajaran' => $item->tahun_ajaran,
                'status' => $this->getStatusLabel($item->status),
                'id' => $item->id
            ];
        });

        return response()->json($data);
    }

    private function getStatusLabel($status)
    {
        $statusMap = [
            'penanganan_walas' => 'Penanganan Walas',
            'penanganan_kesiswaan' => 'Penanganan Kesiswaan',
            'selesai' => 'Selesai',
        ];

        return $statusMap[$status] ?? 'Tidak Diketahui';
    }
}
