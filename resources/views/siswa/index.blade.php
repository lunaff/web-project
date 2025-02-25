@extends('dashboard.master')
@section('title', 'Siswa')
@section('message', 'Siswa')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Siswa')
@section('create', route('siswa.create'))
@section('import', route('siswa.import'))
@section('export', route('export.siswa'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('siswa.edit', ['siswa' => '__siswa_id__']) }}";
        const deleteUrl = "{{ route('siswa.destroy', ['siswa' => '__siswa_id__']) }}";

        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "NIS",
                {
                    name: "Nama Lengkap",
                    formatter: (cell, row) => {
                        const nis = row.cells[0].data; // Ambil NIS dari kolom pertama
                        const nama = cell; // Ambil nama siswa dari kolom ini
                        return gridjs.html(
                            `<a href="/track-record/${nis}" data-bs-toggle="tooltip" title="Ketuk untuk melihat profil siswa">${nama}</a>`
                        );
                    }
                },
                "NIPD",
                "Jenis Kelamin",
                "NISN",
                "Tempat Lahir",
                "Tanggal Lahir",
                "NIK",
                "Agama",
                "Alamat",
                "RT",
                "RW",
                "Kelurahan",
                "Kecamatan",
                "Kode Pos",
                "Jenis Tinggal",
                "Alat Transportasi",
                "No HP",
                "Email",
                "Penerima KPS",
                "No KPS",
                "Kewarganegaraan",
                "Nama Ayah",
                "Tanggal Lahir Ayah",
                "Pendidikan Ayah",
                "Pekerjaan Ayah",
                "Penghasilan Ayah",
                "NIK Ayah",
                "Nama Ibu",
                "Tanggal Lahir Ibu",
                "Pendidikan Ibu",
                "Pekerjaan Ibu",
                "Penghasilan Ibu",
                "NIK Ibu",
                "Nama Wali",
                "Tanggal Lahir Wali",
                "Pendidikan Wali",
                "Pekerjaan Wali",
                "Penghasilan Wali",
                "NIK Wali",
                "No Orang Tua",
                "Kode Kelas",
                "Kode Kompetensi",
                "No Peserta UN",
                "No Seri Ijazah",
                "Penerima KIP",
                "Nomor KIP",
                "Nama di KIP",
                "Nomor KKS",
                "No Registrasi Akta Lahir",
                "Bank",
                "Nomor Rekening Bank",
                "Rekening Atas Nama",
                "Layak PIP",
                "Alasan Layak PIP",
                "Kebutuhan Khusus",
                "Nama Sekolah Asal",
                "Anak Keberapa",
                "Lintang",
                "Bujur",
                "No KK",
                "Berat Badan",
                "Tinggi Badan",
                "Jarak Rumah ke Sekolah",
                "Riwayat Penyakit",
                "Prestasi Akademik",
                "Prestasi Non Akademik",
                "Ekstrakurikuler",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__siswa_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__siswa_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this siswa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    `)
                }
            ],
            server: {
                url: '/siswa/data', // The URL to fetch siswa data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(siswa => [
                        siswa.nis,
                        siswa.nama_lengkap,
                        siswa.nipd,
                        siswa.jk === 'L' ? 'Laki-laki' : 'Perempuan',
                        siswa.nisn,
                        siswa.tempat_lahir,
                        siswa.tanggal_lahir,
                        siswa.nik,
                        siswa.agama,
                        siswa.alamat,
                        siswa.rt,
                        siswa.rw,
                        siswa.kelurahan,
                        siswa.kecamatan,
                        siswa.kode_pos,
                        siswa.jenis_tinggal,
                        siswa.alat_transportasi,
                        siswa.no_hp,
                        siswa.email,
                        siswa.penerima_kps ? "Ya" : "Tidak",
                        siswa.no_kps,
                        siswa.kewarganegaraan,
                        siswa.nama_ayah,
                        siswa.tanggal_lahir_ayah,
                        siswa.jenjang_pendidikan_ayah,
                        siswa.pekerjaan_ayah,
                        siswa.penghasilan_ayah,
                        siswa.nik_ayah,
                        siswa.nama_ibu,
                        siswa.tanggal_lahir_ibu,
                        siswa.jenjang_pendidikan_ibu,
                        siswa.pekerjaan_ibu,
                        siswa.penghasilan_ibu,
                        siswa.nik_ibu,
                        siswa.nama_wali,
                        siswa.tanggal_lahir_wali,
                        siswa.jenjang_pendidikan_wali,
                        siswa.pekerjaan_wali,
                        siswa.penghasilan_wali,
                        siswa.nik_wali,
                        siswa.no_ortu,
                        siswa.kdkelas,
                        siswa.kdkompetensi,
                        siswa.no_peserta_un,
                        siswa.no_seri_ijazah,
                        siswa.penerima_kip ? "Ya" : "Tidak",
                        siswa.nomor_kip,
                        siswa.nama_di_kip,
                        siswa.nomor_kks,
                        siswa.no_registrasi_akta_lahir,
                        siswa.bank,
                        siswa.nomor_rekening_bank,
                        siswa.rekening_atas_nama,
                        siswa.layak_pip ? "Ya" : "Tidak",
                        siswa.alasan_layak_pip,
                        siswa.kebutuhan_khusus,
                        siswa.nama_sekolah_asal,
                        siswa.anak_keberapa,
                        siswa.lintang,
                        siswa.bujur,
                        siswa.no_kk,
                        parseInt(siswa.berat_badan),
                        parseInt(siswa.tinggi_badan),
                        parseInt(siswa.jarak_rmh_sklh),
                        siswa.riwayat_penyakit,
                        siswa.prestasi_akademik,
                        siswa.prestasi_non_akademik,
                        siswa.ekstrakurikuler,
                        null
                    ]);
                }
            },
            pagination: {
                limit: 20
            }, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
