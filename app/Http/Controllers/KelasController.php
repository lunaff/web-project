<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\KompetensiKeahlian;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guru = Guru::all();
        $kompetensi = KompetensiKeahlian::all();
        return view('kelas.create', compact('guru', 'kompetensi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kelas' => 'required',
            'kdkompetensi' => 'required',
            'guru_nip' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        $array = $request->only([
            'kelas',
            'kdkompetensi',
            'guru_nip',
            'tahun_ajaran'
        ]);

        Kelas::create($array);
        return redirect()->route('kelas.index')->with('success_message', 'Berhasil menambah Kelas baru');

        $cari_id = Kelas::where('id', '>', 0)->max('id');

        // Ambil data kelas berdasarkan ID terbesar
        $kelas = Kelas::where('id', $cari_id)->value('kelas'); // Tambahkan first() di sini
        // dd($kelas);

        // Tampilkan data di view dkelas.create
        // return view('dkelas.create', [
        //     'kelas' => $kelas, 
        //     'siswa' => Siswa::all(),
        //     'cari_id' => $cari_id
        // ]);
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
