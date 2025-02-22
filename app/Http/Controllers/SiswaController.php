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
        $request->validate([
            // Data Siswa
            'nama_lengkap' => 'required|string|max:200',
            'nipd' => 'nullable|string|max:50',
            'jk' => 'required|in:L,P',
            'nis' => 'required|string|unique:siswa,nis',
            'nisn' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'nik' => 'nullable|string|max:50',
            'agama' => 'required|in:Islam,Katolik,Protestan,Buddha,Hindu,Lainnya',
            'alamat' => 'required|string|max:300',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'kelurahan' => 'nullable|string|max:150',
            'kecamatan' => 'nullable|string|max:150',
            'kode_pos' => 'nullable|string|max:10',
            'jenis_tinggal' => 'nullable|in:Asrama,Bersama orang tua,Kost,Lainnya,Pesantren,Wali',
            'alat_transportasi' => 'nullable|in:ojek,sepeda motor,angkutan umum,jalan kaki,mobil,antar jemput',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:siswa,email',
            'penerima_kps' => 'required|boolean',
            'no_kps' => 'nullable|string|max:50',
            'kewarganegaraan' => 'required|in:WNI,WNA',

            // Data Orang Tua & Wali
            'nama_ayah' => 'nullable|string|max:50',
            'tanggal_lahir_ayah' => 'nullable|date',
            'jenjang_pendidikan_ayah' => 'nullable|in:SD,SMP,SMA,SMK,D1,D2,D3,D4,S1,S2,S3,lainnya',
            'pekerjaan_ayah' => 'nullable|string',
            'penghasilan_ayah' => 'nullable|string',
            'nik_ayah' => 'nullable|string|size:16',

            'nama_ibu' => 'nullable|string|max:50',
            'tanggal_lahir_ibu' => 'nullable|date',
            'jenjang_pendidikan_ibu' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'nik_ibu' => 'nullable|string|size:16',

            'nama_wali' => 'nullable|string|max:50',
            'tanggal_lahir_wali' => 'nullable|date',
            'jenjang_pendidikan_wali' => 'nullable|string',
            'pekerjaan_wali' => 'nullable|string',
            'penghasilan_wali' => 'nullable|string',
            'nik_wali' => 'nullable|string|size:16',

            'no_ortu' => 'required|string|max:20',

            // Data Tambahan
            'kdkelas' => 'nullable|integer',
            'kdkompetensi' => 'nullable|integer',
            'no_peserta_un' => 'nullable|string|max:50',
            'no_seri_ijazah' => 'nullable|string|max:50',
            'penerima_kip' => 'nullable|boolean',
            'nomor_kip' => 'nullable|string|max:50',
            'nama_di_kip' => 'nullable|string|max:100',
            'nomor_kks' => 'nullable|string|max:50',
            'no_registrasi_akta_lahir' => 'nullable|string|max:100',
            'bank' => 'nullable|string|max:50',
            'nomor_rekening_bank' => 'nullable|string|max:50',
            'rekening_atas_nama' => 'nullable|string|max:150',
            'layak_pip' => 'nullable|boolean',
            'alasan_layak_pip' => 'nullable|in:Dampak Bencana Alam,Menolak,Pemegang PKH/KPS/KKS,Siswa Miskin/Rentan Miskin,Sudah Mampu,Yatim Piatu/Panti Asuhan/Panti Sosial',
            'kebutuhan_khusus' => 'nullable|string|max:100',
            'nama_sekolah_asal' => 'required|string|max:100',
            'anak_keberapa' => 'nullable|integer',
            'lintang' => 'nullable|numeric|between:-90,90',
            'bujur' => 'nullable|numeric|between:-180,180',
            'no_kk' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric|between:0,999.99',
            'tinggi_badan' => 'nullable|numeric|between:0,999.99',
            'jarak_rmh_sklh' => 'nullable|numeric|between:0,9999.999',
            'riwayat_penyakit' => 'nullable|string|max:50',
            'alergi' => 'nullable|string|max:50',
            'prestasi_akademik' => 'nullable|string|max:300',
            'prestasi_non_akademik' => 'nullable|string|max:300',
            'ekstrakurikuler' => 'nullable|string|max:50',
            'biografi' => 'nullable|string|max:500',
        ]);

        $array = $request->only([
            'nama_lengkap', 'nipd', 'jk', 'nis', 'nisn', 'tempat_lahir', 'tanggal_lahir',
            'nik', 'agama', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos',
            'jenis_tinggal', 'alat_transportasi', 'no_hp', 'email', 'penerima_kps',
            'no_kps', 'kewarganegaraan',

            // Data Orang Tua & Wali
            'nama_ayah', 'tanggal_lahir_ayah', 'jenjang_pendidikan_ayah', 'pekerjaan_ayah',
            'penghasilan_ayah', 'nik_ayah', 'nama_ibu', 'tanggal_lahir_ibu', 'jenjang_pendidikan_ibu',
            'pekerjaan_ibu', 'penghasilan_ibu', 'nik_ibu', 'nama_wali', 'tanggal_lahir_wali',
            'jenjang_pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali', 'nik_wali', 'no_ortu',

            // Data Tambahan
            'kdkelas', 'kdkompetensi', 'no_peserta_un', 'no_seri_ijazah', 'penerima_kip',
            'nomor_kip', 'nama_di_kip', 'nomor_kks', 'no_registrasi_akta_lahir', 'bank',
            'nomor_rekening_bank', 'rekening_atas_nama', 'layak_pip', 'alasan_layak_pip',
            'kebutuhan_khusus', 'nama_sekolah_asal', 'anak_keberapa', 'lintang', 'bujur',
            'no_kk', 'berat_badan', 'tinggi_badan', 'jarak_rmh_sklh', 'riwayat_penyakit',
            'alergi', 'prestasi_akademik', 'prestasi_non_akademik', 'ekstrakurikuler', 'biografi'
        ]);

        // Simpan data ke database
        $siswa = Siswa::create($array);
        // dd($siswa);
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
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
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        }
        $request->validate([
            'nis' => [
                'required',
                Rule::unique('siswa')->ignore($siswa->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('siswa')->ignore($siswa->id),
            ],
            'nama_lengkap' => 'required|string|max:200',
            'nipd' => 'nullable|string|max:50',
            'jk' => 'required|in:L,P',
            'nisn' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'nik' => 'nullable|string|max:50',
            'agama' => 'required|in:Islam,Katolik,Protestan,Buddha,Hindu,Lainnya',
            'alamat' => 'required|string|max:300',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'kelurahan' => 'nullable|string|max:150',
            'kecamatan' => 'nullable|string|max:150',
            'kode_pos' => 'nullable|string|max:10',
            'jenis_tinggal' => 'nullable|in:Asrama,Bersama orang tua,Kost,Lainnya,Pesantren,Wali',
            'alat_transportasi' => 'nullable|in:ojek,sepeda motor,angkutan umum,jalan kaki,mobil,antar jemput',
            'no_hp' => 'required|string|max:20',
            'penerima_kps' => 'required|boolean',
            'no_kps' => 'nullable|string|max:50',
            'kewarganegaraan' => 'required|in:WNI,WNA',

            // Data Orang Tua & Wali
            'nama_ayah' => 'nullable|string|max:50',
            'tanggal_lahir_ayah' => 'nullable|date',
            'jenjang_pendidikan_ayah' => 'nullable|in:SD,SMP,SMA,SMK,D1,D2,D3,D4,S1,S2,S3,lainnya',
            'pekerjaan_ayah' => 'nullable|string',
            'penghasilan_ayah' => 'nullable|string',
            'nik_ayah' => 'nullable|string|size:16',

            'nama_ibu' => 'nullable|string|max:50',
            'tanggal_lahir_ibu' => 'nullable|date',
            'jenjang_pendidikan_ibu' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'nik_ibu' => 'nullable|string|size:16',

            'nama_wali' => 'nullable|string|max:50',
            'tanggal_lahir_wali' => 'nullable|date',
            'jenjang_pendidikan_wali' => 'nullable|string',
            'pekerjaan_wali' => 'nullable|string',
            'penghasilan_wali' => 'nullable|string',
            'nik_wali' => 'nullable|string|size:16',

            'no_ortu' => 'required|string|max:20',
            // Data Tambahan
            'kdkelas',
            'kdkompetensi',
            'no_peserta_un' => 'nullable|string|max:50',
            'no_seri_ijazah' => 'nullable|string|max:50',
            'penerima_kip' => 'nullable|boolean',
            'nomor_kip' => 'nullable|string|max:50',
            'nama_di_kip' => 'nullable|string|max:100',
            'nomor_kks' => 'nullable|string|max:50',
            'no_registrasi_akta_lahir' => 'nullable|string|max:100',
            'bank' => 'nullable|string|max:50',
            'nomor_rekening_bank' => 'nullable|string|max:50',
            'rekening_atas_nama' => 'nullable|string|max:150',
            'layak_pip' => 'nullable|boolean',
            'alasan_layak_pip' => 'nullable|in:Dampak Bencana Alam,Menolak,Pemegang PKH/KPS/KKS,Siswa Miskin/Rentan Miskin,Sudah Mampu,Yatim Piatu/Panti Asuhan/Panti Sosial',
            'kebutuhan_khusus' => 'nullable|string|max:100',
            'nama_sekolah_asal' => 'required|string|max:100',
            'anak_keberapa' => 'nullable|integer',
            'lintang' => 'nullable|numeric|between:-90,90',
            'bujur' => 'nullable|numeric|between:-180,180',
            'no_kk' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric|between:0,999.99',
            'tinggi_badan' => 'nullable|numeric|between:0,999.99',
            'jarak_rmh_sklh' => 'nullable|numeric|between:0,9999.999',
            'riwayat_penyakit' => 'nullable|string|max:50',
            'alergi' => 'nullable|string|max:50',
            'prestasi_akademik' => 'nullable|string|max:300',
            'prestasi_non_akademik' => 'nullable|string|max:300',
            'ekstrakurikuler' => 'nullable|string|max:50',
            'biografi' => 'nullable|string|max:500',
        ]);
    
        $array = $request->only([
            'nama_lengkap', 'nipd', 'jk', 'nis', 'nisn', 'tempat_lahir', 'tanggal_lahir',
            'nik', 'agama', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos',
            'jenis_tinggal', 'alat_transportasi', 'no_hp', 'email', 'penerima_kps',
            'no_kps', 'kewarganegaraan',

            // Data Orang Tua & Wali
            'nama_ayah', 'tanggal_lahir_ayah', 'jenjang_pendidikan_ayah', 'pekerjaan_ayah',
            'penghasilan_ayah', 'nik_ayah', 'nama_ibu', 'tanggal_lahir_ibu', 'jenjang_pendidikan_ibu',
            'pekerjaan_ibu', 'penghasilan_ibu', 'nik_ibu', 'nama_wali', 'tanggal_lahir_wali',
            'jenjang_pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali', 'nik_wali', 'no_ortu',

            // Data Tambahan
            'kdkelas', 'kdkompetensi', 'no_peserta_un', 'no_seri_ijazah', 'penerima_kip',
            'nomor_kip', 'nama_di_kip', 'nomor_kks', 'no_registrasi_akta_lahir', 'bank',
            'nomor_rekening_bank', 'rekening_atas_nama', 'layak_pip', 'alasan_layak_pip',
            'kebutuhan_khusus', 'nama_sekolah_asal', 'anak_keberapa', 'lintang', 'bujur',
            'no_kk', 'berat_badan', 'tinggi_badan', 'jarak_rmh_sklh', 'riwayat_penyakit',
            'alergi', 'prestasi_akademik', 'prestasi_non_akademik', 'ekstrakurikuler', 'biografi'
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
