<?php

namespace App\Http\Controllers;
use App\Models\Pelanggaran;
use App\Models\Siswa;

use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggaran = Pelanggaran::with('siswa')->latest()->paginate(10);
        return view('pelanggaran.index', compact('pelanggaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('pelanggaran.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'deskripsi' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,png,mp4|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('public/bukti_pelanggaran');
        }

        $pelanggaran = Pelanggaran::create([
            'deskripsi' => $request->deskripsi,
            'bukti' => $buktiPath,
        ]);

        // Menyimpan relasi many-to-many dengan siswa
        $pelanggaran->siswa()->attach($request->siswa_id);

        return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
