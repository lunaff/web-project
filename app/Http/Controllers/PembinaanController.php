<?php

namespace App\Http\Controllers;

use App\Models\Pembinaan;
use App\Models\LaporanKasus;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'no' => $index + 1,
                'kasus' => $pembinaan->kasus->kasus ?? 'Tidak Ada',
                'guru' => $pembinaan->guru->nama_guru ?? 'Tidak Ada',
                'tanggal_mulai' => $pembinaan->tanggal_mulai,
                'tanggal_selesai' => $pembinaan->tanggal_selesai ?? '-',
                'durasi' => method_exists($pembinaan, 'hitungDurasi') ? $pembinaan->hitungDurasi() : '-',
                'status' => ucfirst($pembinaan->status),
                'note' => $pembinaan->note ?? '-',
                'id' => $pembinaan->id,
                'status_pembinaan' => ucfirst($pembinaan->status),
            ];
        });

        // dd($data->toArray());

        return response()->json($data);
    }

    public function create(Request $request)
    {
        // Ambil ID dari query string (bisa null)
        $laporan_kasus_id = $request->query('laporan_kasus_id');

        if ($laporan_kasus_id) {
            $pembinaan = Pembinaan::where('id_kasus', $laporan_kasus_id)->first();
            if ($pembinaan) {
                return redirect()->route('pembinaan.edit', ['pembinaan' => $pembinaan->id]);
            }
        }
    
        // Ambil semua kasus yang belum masuk pembinaan
        $kasusTersimpan = Pembinaan::pluck('id_kasus')->toArray();
        $kasus = LaporanKasus::where('dampingan_bk', true)
            ->whereNotIn('id', $kasusTersimpan)
            ->get();
    
        $guru = Guru::all();
    
        // Ambil data kasus jika ada, jika tidak biarkan null
        $selectedKasus = $laporan_kasus_id ? LaporanKasus::find($laporan_kasus_id) : null;
    
        return view('pembinaan.create', compact('kasus', 'guru', 'selectedKasus'));
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

    public function edit($id)
    {
        $pembinaan = Pembinaan::findOrFail($id);
        $kasusTersimpan = Pembinaan::pluck('id_kasus')->toArray(); // Ambil semua ID kasus di pembinaan

        $kasus = LaporanKasus::where('dampingan_bk', true)
            ->whereNotIn('id', $kasusTersimpan) // Hindari kasus yang sudah ada di pembinaan
            ->get();

        $guru = Guru::all();
        return view('pembinaan.edit', compact('pembinaan', 'kasus', 'guru'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data pembinaan
        $pembinaan = Pembinaan::findOrFail($id);
    
        // Validasi hanya kolom yang ada di request
        $validatedData = $request->validate([
            'id_kasus' => 'sometimes|required|exists:laporan_kasus,id',
            'id_guru' => 'sometimes|required|exists:guru,id',
            'tanggal_mulai' => 'sometimes|required|date',
            'tanggal_selesai' => 'sometimes|nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'sometimes|required|in:kasus baru,dalam pembinaan,kasus selesai',
            'note' => 'sometimes|nullable|string',
        ]);
    
        // Update hanya kolom yang dikirim
        $pembinaan->fill($validatedData)->save();

        if ($request->status === 'kasus selesai') {
            DB::table('laporan_kasus')
                ->where('id', $pembinaan->id_kasus)
                ->update(['status' => 'selesai']);
        }
    
        return redirect()->route('pembinaan.index')->with('success', 'Data Pembinaan berhasil diperbarui.');
    }    

    public function destroy($id)
    {
        Pembinaan::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Pembinaan berhasil dihapus.']);
    }
}
