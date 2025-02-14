<?php

namespace App\Http\Controllers;

use App\Models\KunjunganRumah;
use App\Models\LaporanKasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KunjunganRumahController extends Controller
{
    public function index()
    {
        return view('kunjungan-rumah.index');
    }

    public function show()
    {
        $kunjunganRumah = KunjunganRumah::with(['laporanKasus.siswa'])->get();

        $data = $kunjunganRumah->map(function ($item) {
            return [
                'id' => $item->id,
                'tanggal' => Carbon::parse($item->tanggal)->format('d-m-Y'),
                'nama_siswa' => $item->laporanKasus->siswa->nama_lengkap ?? 'Tidak ada data',
                'kasus' => $item->laporanKasus->kasus ?? 'Tidak ada data',
                'solusi' => $item->solusi,
                'surat' => $item->surat,
                'dokumentasi' => $item->dokumentasi,
            ];
        });

        return response()->json($data);
    }

    public function create()
    {
        $laporanKasus = LaporanKasus::all();
        return view('kunjungan-rumah.create', compact('laporanKasus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idKasus' => 'required|exists:laporan_kasus,id',
            'tanggal' => 'required|date',
            'solusi' => 'nullable|string',
            'surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'dokumentasi' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $suratPath = $request->file('surat') ? $request->file('surat')->storeAs('surat', $request->file('surat')->getClientOriginalName(), 'public') : null;
        $dokumentasiPath = $request->file('dokumentasi') ? $request->file('dokumentasi')->store('dokumentasi', 'public') : null;

        KunjunganRumah::create([
            'idKasus' => $request->idKasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
            'surat' => $suratPath,
            'dokumentasi' => $dokumentasiPath,
        ]);

        return redirect()->route('kunjungan-rumah.index')->with('success', 'Kunjungan rumah berhasil ditambahkan');
    }

    public function edit(KunjunganRumah $kunjunganRumah)
    {
        $laporanKasus = LaporanKasus::all();
        return view('kunjungan-rumah.edit', compact('kunjunganRumah', 'laporanKasus'));
    }

    public function update(Request $request, KunjunganRumah $kunjunganRumah)
    {
        $request->validate([
            'idKasus' => 'required|exists:laporan_kasus,id',
            'tanggal' => 'required|date',
            'solusi' => 'nullable|string',
            'surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'dokumentasi' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('surat')) {
            if ($kunjunganRumah->surat) {
                Storage::disk('public')->delete($kunjunganRumah->surat);
            }
            $suratPath = $request->file('surat')->storeAs('surat', $request->file('surat')->getClientOriginalName(), 'public');
        } else {
            $suratPath = $kunjunganRumah->surat;
        }

        if ($request->hasFile('dokumentasi')) {
            if ($kunjunganRumah->dokumentasi) {
                Storage::disk('public')->delete($kunjunganRumah->dokumentasi);
            }
            $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public');
        } else {
            $dokumentasiPath = $kunjunganRumah->dokumentasi;
        }

        $kunjunganRumah->update([
            'idKasus' => $request->idKasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
            'surat' => $suratPath,
            'dokumentasi' => $dokumentasiPath,
        ]);

        return redirect()->route('kunjungan-rumah.index')->with('success', 'Data kunjungan rumah berhasil diperbarui');
    }

    public function destroy(KunjunganRumah $kunjunganRumah)
    {
        if ($kunjunganRumah->surat) {
            Storage::disk('public')->delete($kunjunganRumah->surat);
        }

        if ($kunjunganRumah->dokumentasi) {
            Storage::disk('public')->delete($kunjunganRumah->dokumentasi);
        }

        $kunjunganRumah->delete();

        return redirect()->route('kunjungan-rumah.index')->with('success', 'Data kunjungan rumah berhasil dihapus');
    }
}
