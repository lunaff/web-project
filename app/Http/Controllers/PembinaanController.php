<?php

namespace App\Http\Controllers;

use App\Models\Pembinaan;
use App\Models\LaporanKasus;
use App\Models\Guru;
use Illuminate\Http\Request;

class PembinaanController extends Controller
{
    public function index()
    {
        return view('pembinaan.index');
    }

    public function show()
    {
        $pembinaan = Pembinaan::with(['kasus', 'guru'])->get();

        $data = $pembinaan->map(function ($pembinaan, $index) {
            return [
                'id' => $pembinaan->id,
                'no' => $index + 1,
                'kasus' => $pembinaan->kasus->kasus ?? 'Tidak Ada',
                'guru' => $pembinaan->guru->nama_guru ?? 'Tidak Ada',
                'tanggal_mulai' => $pembinaan->tanggal_mulai,
                'tanggal_selesai' => $pembinaan->tanggal_selesai ?? '-',
                'durasi' => method_exists($pembinaan, 'hitungDurasi') ? $pembinaan->hitungDurasi() : '-',
                'status' => ucfirst($pembinaan->status),
                'note' => $pembinaan->note ?? '-'
            ];
        });

        return response()->json($data);
    }


    public function create()
    {
        $kasus = LaporanKasus::all();
        $guru = Guru::all();
        return view('pembinaan.create', compact('kasus', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kasus' => 'required|exists:laporan_kasus,id',
            'id_guru' => 'required|exists:guru,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:kasus baru,dalam pembinaan,kasus selesai',
            'note' => 'nullable|string'
        ]);

        $pembinaan = Pembinaan::create($request->all());

        return redirect()->route('pembinaan.index')->with('success', 'Data Pembinaan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Pembinaan::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Pembinaan berhasil dihapus.']);
    }
}
