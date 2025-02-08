<?php

namespace App\Http\Controllers;

use App\Models\KompetensiKeahlian;
use App\Models\Guru;
use Illuminate\Http\Request;

class KompetensiKeahlianController extends Controller
{
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
        return redirect()->route('kompetensi-keahlian.index')->with('success_message', 'Berhasil menambah Kompetensi Keahlian baru');
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
