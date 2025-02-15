<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LaporanKasus;
use App\Models\Prestasi;

class ReportController extends Controller
{
    //    
    public function getLaporanKasus(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun ini kalau gak ada input
        $data = LaporanKasus::whereYear('tanggal', $tahun) 
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total_kasus')
            ->pluck('total_kasus')
            ->toArray();
    
        return response()->json($data);
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
    
    private function formatData($data)
    {
        $formattedData = array_fill(0, 12, 0); // Inisialisasi 12 bulan

        foreach ($data as $d) {
            $formattedData[$d->month - 1] = $d->total;
        }

        return $formattedData;
    }
}
