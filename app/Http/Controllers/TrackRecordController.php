<?php
namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class TrackRecordController extends Controller
{
    public function index($nis)
    {
        // Ambil data siswa berdasarkan NIS beserta relasinya
        $siswa = Siswa::with([
            'fkelas',
            'fkompetensi',
            'pelanggaran',
            'laporanKasus.pembinaan'
        ])->find($nis);

        // Jika data siswa tidak ditemukan, kembalikan response 404
        if (!$siswa) {
            abort(404, 'Siswa tidak ditemukan');
        }

        // Tampilkan view track-record dengan data siswa
        return view('track-record.index', compact('siswa'));
    }
}
