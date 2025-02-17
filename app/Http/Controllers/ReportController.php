<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use App\Models\LaporanKasus;
use App\Models\Pelanggaran;
use App\Models\Pembinaan;
use App\Models\Prestasi;
use App\Models\Kegiatan;

class ReportController extends Controller
{
    //  
    public function getJumlahSiswa()
    {
        try {
            $jumlahSiswa = Siswa::where('active', 1)->where('jk', 'L')->count();
            $jumlahSiswi = Siswa::where('active', 1)->where('jk', 'P')->count();
            return response()->json([
                'total_siswa' => $jumlahSiswa,
                'total_siswi' => $jumlahSiswi,
                'total' => $jumlahSiswa + $jumlahSiswi
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function topKasus()
    {
        try {
            $topSiswa = LaporanKasus::select('kdsiswa', DB::raw('COUNT(*) as total_kasus'))
                ->groupBy('kdsiswa')
                ->orderByDesc('total_kasus')
                ->with(['siswa.fkelas']) // Relasi siswa -> fkelas
                ->limit(6)
                ->get();
    
            return response()->json($topSiswa->map(function ($kasus) {
                return [
                    'nama_lengkap' => $kasus->siswa->nama_lengkap ?? 'Tidak Diketahui',
                    'kelas' => $kasus->siswa->fkelas->kelas ?? 'Tidak Ada', // Ambil kelas dari relasi fkelas()
                    'total_kasus' => $kasus->total_kasus,
                ];
            }));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }      

    public function getPrestasiTerbaru()
    {
        $prestasi = Prestasi::with('siswa') // Ambil relasi siswa
            ->orderBy('tanggal', 'desc') // Urutkan dari yang terbaru
            ->limit(6) // Ambil hanya 6 data terbaru
            ->get();
    
        return response()->json($prestasi);
    }

    public function getLaporanKasus(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun ini kalau gak ada input
        $data = LaporanKasus::whereYear('tanggal', $tahun) 
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total_kasus')
            ->get();
    
        return response()->json($this->formatData($data));
    }
    
    public function getPrestasiData(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun ini kalau gak ada input
        $data = Prestasi::whereYear('tanggal', $tahun) 
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total_prestasi')
            ->get();
    
        return response()->json($this->formatData($data));
    }

    public function getJumlahPelanggaran(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun ini kalau gak ada input
        $data = Pelanggaran::whereYear('tanggal', $tahun) 
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total_pelanggaran')
            ->get();
    
        return response()->json($this->formatData($data));
    }

    public function getJumlahPembinaan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun ini kalau gak ada input
    
        $data = Pembinaan::whereYear('tanggal_mulai', '<=', $tahun) // Mulai di tahun ini atau sebelumnya
            ->whereYear('tanggal_selesai', '>=', $tahun) // Selesai di tahun ini atau setelahnya
            ->selectRaw('MONTH(tanggal_mulai) as bulan_mulai, MONTH(tanggal_selesai) as bulan_selesai')
            ->get();
    
        // Format data untuk setiap bulan dalam tahun yang dipilih
        $formattedData = array_fill(0, 12, 0); // Inisialisasi 12 bulan dengan nilai 0
    
        foreach ($data as $d) {
            $bulan_mulai = max(1, (int)$d->bulan_mulai); // Pastikan tidak kurang dari Januari
            $bulan_selesai = min(12, (int)$d->bulan_selesai); // Pastikan tidak lebih dari Desember
    
            for ($i = $bulan_mulai; $i <= $bulan_selesai; $i++) {
                $formattedData[$i - 1]++; // Tambahkan ke bulan yang sesuai (index mulai dari 0)
            }
        }
    
        return response()->json($formattedData);
    }    
    
    private function formatData($data)
    {
        $formattedData = array_fill(0, 12, 0); // Inisialisasi 12 bulan dengan 0
    
        foreach ($data as $d) {
            $formattedData[$d->bulan - 1] = $d->total_prestasi ?? $d->total_kasus; // Masukkan ke array
        }
    
        return $formattedData;
    }

    public function getUpcomingKegiatan()
    {
        // Ambil kegiatan yang masih akan datang berdasarkan tanggal
        $kegiatan = Kegiatan::where('tanggal', '>', now()) // Mengambil kegiatan yang tanggalnya lebih besar dari hari ini
                            ->orderBy('tanggal', 'asc') // Mengurutkan berdasarkan tanggal
                            ->take(2) // Mengambil 6 kegiatan
                            ->get();

        // Mengembalikan response dalam format JSON
        return response()->json($kegiatan);
    }
    
}
