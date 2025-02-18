<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\KompetensiKeahlian;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return back()->with('success', 'Data siswa berhasil diimport!');
    }
    
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
            'riwayat_penyakit' => 'nullable',
            'alergi' => 'nullable',
            'prestasi_akademik' => 'nullable',
            'prestasi_non_akademik' => 'nullable',
            'ekstrakurikuler' => 'nullable',
            'biografi' => 'nullable'
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

        return redirect()->route('siswa.index')->with('success', 'Berhasil menambah siswa baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Memuat relasi 'fkelas' dan 'fkompetensi' dengan query 'with'
        $siswas = Siswa::with('fkelas', 'fkompetensi')->get();
    
        // Mengubah data siswa hanya untuk field tertentu tanpa mendeklarasikan semuanya
        $data = $siswas->map(function ($siswa) {
            // Ambil semua data siswa, lalu ganti field tertentu dengan nama
            $siswaAttributes = $siswa->getAttributes();
    
            // Ganti 'kdkelas' dan 'kdkompetensi' dengan nama
            if ($siswa->fkelas) {
                $siswaAttributes['kdkelas'] = $siswa->fkelas->kelas;
            } else {
                $siswaAttributes['kdkelas'] = '-';
            }
    
            if ($siswa->fkompetensi) {
                $siswaAttributes['kdkompetensi'] = $siswa->fkompetensi->kompetensi_keahlian;
            } else {
                $siswaAttributes['kdkompetensi'] = '-';
            }
    
            // Return hasil dengan mengganti hanya field yang diperlukan
            return $siswaAttributes;
        });
    
        // Return data as JSON
        return response()->json($data);
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        $kompetensi = KompetensiKeahlian::all();
        if (!$siswa) return redirect()->route('siswa.index')
            ->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        return view('siswa.edit', compact('siswa', 'kelas', 'kompetensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        }

        $request->validate([
            'nis' => [
                'required',
                Rule::unique('siswa')->ignore($siswa->id),
            ],
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit' => 'nullable',
            'alergi' => 'nullable',
            'prestasi_akademik' => 'nullable',
            'prestasi_non_akademik' => 'nullable',
            'ekstrakurikuler' => 'nullable',
            'biografi' => 'nullable'
        ]);

        $array = $request->only([
            'nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
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

        $siswa->update($array);

        $siswa->fkelas()->associate($request->input('kdkelas'));
        $siswa->fkompetensi()->associate($request->input('kdkompetensi'));

        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $siswa = Siswa::find($id);
    
        if (!$siswa) {
            return redirect()->route('siswa.index')
                ->with('error_message', 'Siswa with ID ' . $id . ' not found.');
        }
    
        $siswa->delete();
    
        return redirect()->route('siswa.index')
            ->with('success', 'Siswa deleted successfully.');
    }

    public function exportSiswa()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }
}
