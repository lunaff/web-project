<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\KompetensiKeahlian;
use App\Imports\KelasImport;
use App\Exports\KelasExport;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new KelasImport, $request->file('file'));

        return back()->with('success', 'Data kelas berhasil diimport!');
    }

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
        return redirect()->route('kelas.index')->with('success', 'Berhasil menambah Kelas baru');

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
        $kelas = Kelas::with(['fguru', 'fkompetensi'])->get();

        // Mengubah data kelas menjadi format yang diinginkan
        $data = $kelas->map(function ($kelas) {
            return [
                'id' => $kelas->id,
                'kelas' => $kelas->kelas,
                'guru_nip' => $kelas->fguru ? $kelas->fguru->nama_guru : '-', // Nama guru jika ada
                'kdkompetensi' => $kelas->fkompetensi ? $kelas->fkompetensi->kompetensi_keahlian : '-', // Nama kompetensi jika ada
                'tahun_ajaran' => $kelas->tahun_ajaran ? $kelas->tahun_ajaran : '-',
            ];
        });
    
        // Kembalikan data dalam bentuk JSON
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kelas = Kelas::find($id);
        $kompetensi = KompetensiKeahlian::all();
        $guru = Guru::all();

        if (!$kelas) return redirect()->route('kelas.index')
            ->with('error_message', 'Kelas dengan id = ' . $id . ' tidak ditemukan');
        return view('kelas.edit', compact('kelas', 'kompetensi', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'kelas' => 'required|unique:kelas,kelas,' . $id
        ]);
        $kelas = Kelas::find($id);
        $kelas->kelas = $request->kelas;
        $kelas->kdkompetensi = $request->kdkompetensi;
        $kelas->guru_nip = $request->guru_nip;
        $kelas->tahun_ajaran = $request->tahun_ajaran;
        $kelas->save();
        return redirect()->route('kelas.index')
            ->with('success', 'Berhasil mengubah Kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kelas = Kelas::find($id);
    
        if (!$kelas) {
            return redirect()->route('kelas.index')
                ->with('error_message', 'Kelas with ID ' . $id . ' not found.');
        }
    
        $kelas->delete();
    
        return redirect()->route('kelas.index')
            ->with('success', 'Kelas deleted successfully.');
    }
    public function exportKelas()
    {
        return Excel::download(new KelasExport, 'data_kelas.xlsx');
    }
}
