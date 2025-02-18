<?php

namespace App\Http\Controllers;

use App\Models\KompetensiKeahlian;
use App\Models\Guru;
use App\Imports\KompetensiKeahlianImport;
use App\Exports\KompetensiKeahlianExport;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KompetensiKeahlianController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new KompetensiKeahlianImport, $request->file('file'));

        return back()->with('success', 'Data kompetensi keahlian berhasil diimport!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('kompetensi-keahlian.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guru = Guru::all();
        return view('kompetensi-keahlian.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kompetensi_keahlian' => 'required|unique:kompetensi_keahlian,kompetensi_keahlian',
            'guru_nip' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        $array = $request->only([
            'kompetensi_keahlian',
            'guru_nip',
            'tahun_ajaran'
        ]);

        KompetensiKeahlian::create($array);
        return redirect()->route('kompetensi-keahlian.index')->with('success', 'Berhasivalue: l menambah Kompetensi Keahlian baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $kompetensi = KompetensiKeahlian::with(['fguru'])->get();

        // Mengubah data kelas menjadi format yang diinginkan
        $data = $kompetensi->map(function ($kompetensi) {
            return [
                'id' => $kompetensi->id,
                'kompetensi_keahlian' => $kompetensi->kompetensi_keahlian,
                'guru_nip' => $kompetensi->fguru ? $kompetensi->fguru->nama_guru : '-', // Nama guru jika ada
                'tahun_ajaran' => $kompetensi->tahun_ajaran ? $kompetensi->tahun_ajaran : '-',
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
        $kompetensi = KompetensiKeahlian::find($id);
        $guru = Guru::all();

        if (!$kompetensi) return redirect()->route('kompetensi-keahlian.index')
            ->with('error_message', 'kompetensi dengan id = ' . $id . ' tidak ditemukan');
        return view('kompetensi-keahlian.edit', compact('kompetensi', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'kompetensi_keahlian' =>
            'required|unique:kompetensi_keahlian,kompetensi_keahlian,' . $id
        ]);
        $kompetensi = KompetensiKeahlian::find($id);
        $kompetensi->kompetensi_keahlian = $request->kompetensi_keahlian;
        $kompetensi->guru_nip = $request->guru_nip;
        $kompetensi->tahun_ajaran = $request->tahun_ajaran;
        $kompetensi->save();
        return redirect()->route('kompetensi-keahlian.index')->with('success', 'Berhasil mengubah Kompetensi Keahlian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kompetensi = KompetensiKeahlian::find($id);
    
        if (!$kompetensi) {
            return redirect()->route('kompetensi-keahlian.index')
                ->with('error_message', 'Kompetensi Keahlian with ID ' . $id . ' not found.');
        }
    
        $kompetensi->delete();
    
        return redirect()->route('kompetensi-keahlian.index')
            ->with('success', 'Kompetensi Keahlian deleted successfully.');
    }

    public function exportKompK()
    {
        return Excel::download(new KompetensiKeahlianExport, 'data_kompKeahlian.xlsx');
    }
}
