<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\KompetensiKeahlian;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kelas = Kelas::all();
        $kompetensi = KompetensiKeahlian::all();
        return view('siswa.create', compact('kelas', 'kompetensi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([

            'nis' => 'required|unique:siswa,nis',
            'kdkelas',
            'kdkompetensi',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $array = $request->only([
            'nis',
            'kdkelas',
            'kdkompetensi',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);
        $siswa = Siswa::create($array);

        // // Associate the student with the class and competency
        // $siswa->fkelas()->associate($request->input('kdkelas'));
        // $siswa->fkompetensi()->associate($request->input('kdkompetensi'));

        $siswa->save();

        return redirect()->route('siswa.index')->with('success_message', 'Berhasil menambah siswa baru');
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
