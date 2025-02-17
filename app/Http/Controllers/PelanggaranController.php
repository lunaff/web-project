<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PelanggaranController extends Controller
{
    public function index()
    {
        return view('pelanggaran.index');
    }

    // Method untuk menampilkan data JSON (dipakai oleh Grid.js)
    public function show()
    {
        $pelanggaran = Pelanggaran::with('siswa')->get();

        $data = $pelanggaran->map(function ($item, $index) {
            return [
                'no'         => $index + 1,
                'tanggal'    => Carbon::parse($item->tanggal)->format('d-m-Y'),
                'jenis'      => ucfirst($item->jenis),
                'keterangan' => $item->keterangan,
                'nama_siswa' => $item->siswa->pluck('nama_lengkap')->join(', '),
                'bukti'      => $item->bukti ? asset('storage/' . $item->bukti) : null,
                'sanksi'     => $item->sanksi,
                'id'         => $item->id,
            ];
        });

        return response()->json($data);
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('pelanggaran.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:terlambat,perilaku,penampilan,asusila',
            'keterangan' => 'required|string',
            'bukti'      => 'nullable|file|mimes:jpg,jpeg,png,mp4',
            'sanksi'     => 'required|string',
            'siswa_ids'  => 'required|string',
        ]);

        // Konversi siswa_ids ke array
        $siswa_ids = explode(',', $request->siswa_ids);

        // Simpan pelanggaran
        $pelanggaran = Pelanggaran::create($request->only('tanggal', 'jenis', 'keterangan', 'sanksi'));

        // Simpan bukti jika ada
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pelanggaran', 'public');
            // dd($path); // Cek apakah path file tersimpan
            $pelanggaran->update(['bukti' => $path]);
        }

        // Hubungkan dengan siswa
        $pelanggaran->siswa()->attach($siswa_ids);

        return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan.');
    }


    public function edit(Pelanggaran $pelanggaran)
    {
        $siswa = Siswa::all();
        $pelanggaran->load('siswa');

        // Jika ada old value, pakai old, jika tidak, ambil dari pelanggaran->siswa
        $selectedSiswa = old('siswa_ids') ? explode(',', old('siswa_ids')) : $pelanggaran->siswa->pluck('nis')->toArray();

        return view('pelanggaran.edit', compact('pelanggaran', 'siswa', 'selectedSiswa'));
    }


    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:terlambat,perilaku,penampilan,asusila',
            'keterangan' => 'required|string',
            'bukti'      => 'nullable|file|mimes:jpg,jpeg,png,mp4',
            'sanksi'     => 'required|string',
            'siswa_ids'  => 'required|string',
        ]);

        // Konversi siswa_ids menjadi array
        $siswa_ids = explode(',', $request->siswa_ids);

        // Update pelanggaran
        $pelanggaran->update($request->only('tanggal', 'jenis', 'keterangan', 'sanksi'));

        // Hapus bukti lama jika ada permintaan hapus
        if ($request->has('hapus_bukti') && $pelanggaran->bukti) {
            Storage::delete('public/' . $pelanggaran->bukti);
            $pelanggaran->update(['bukti' => null]);
        }

        // Simpan bukti baru jika ada
        if ($request->hasFile('bukti')) {
            if ($pelanggaran->bukti) {
                Storage::delete('public/' . $pelanggaran->bukti);
            }
            $path = $request->file('bukti')->store('bukti_pelanggaran', 'public');
            // dd($path); // Cek apakah path file tersimpan
            $pelanggaran->update(['bukti' => $path]);
        }

        // Sinkronisasi siswa yang dipilih
        $pelanggaran->siswa()->sync($siswa_ids);

        return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil diperbarui.');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        if ($pelanggaran->bukti) {
            Storage::delete('public/' . $pelanggaran->bukti);
        }
        $pelanggaran->siswa()->detach();
        $pelanggaran->delete();

        return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil dihapus.');
    }
}
