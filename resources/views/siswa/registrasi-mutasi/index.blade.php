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

@section('page', ' Registrasi/Mutasi Siswa')

@section('main')
    @include('table2')

    <!-- Modal Registrasi -->
    <div class="modal fade" id="registrasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Registrasi Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrasiForm" action="{{ route('siswa.registrasi') }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" id="regisNIS" class="form-control" name="siswa_nis" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Pendaftaran</label>
                            <select class="form-control" name="jenis_pendaftaran">
                                <option value="Siswa Baru" {{ old('jenis_pendaftaran') == 'Siswa Baru' ? 'selected' : '' }}>Siswa Baru</option>
                                <option value="Pindahan" {{ old('jenis_pendaftaran') == 'Pindahan' ? 'selected' : '' }}>Pindahan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Ijazah SMP</label>
                            <input type="text" name="no_ijazah" class="form-control" id="noIjazah" value="{{ old('no_ijazah') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mutasi -->
    <div class="modal fade" id="mutasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Mutasi Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="mutasiForm" action="{{ route('siswa.mutasi') }}" method="post">
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" id="mutasiNIS" class="form-control" name="siswa_nis" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keluar Karena</label>
                            <select class="form-control" name="alasan">
                                <option value="Lulus" {{ old('alasan') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="Mutasi" {{ old('alasan') == 'Mutasi' ? 'selected' : '' }}>Mutasi</option>
                                <option value="Dikeluarkan" {{ old('alasan') == 'Dikeluarkan' ? 'selected' : '' }}>Dikeluarkan</option>
                                <option value="Mengundurkan diri" {{ old('alasan') == 'Mengundurkan diri' ? 'selected' : '' }}>Mengundurkan diri</option>
                                <option value="Putus Sekolah" {{ old('alasan') == 'Putus Sekolah' ? 'selected' : '' }}>Putus Sekolah</option>
                                <option value="Wafat" {{ old('alasan') == 'Wafat' ? 'selected' : '' }}>Wafat</option>
                                <option value="Hilang" {{ old('alasan') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                                <option value="Lainnya" {{ old('alasan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" value="{{ old('tanggal_keluar') }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new gridjs.Grid({
                columns: [
                    "NIS",
                    {
                        name: "Nama Lengkap",
                        formatter: (cell, row) => {
                            const nis = row.cells[0].data;
                            const nama = cell;
                            return gridjs.html(
                                `<a href="/track-record/${nis}" data-bs-toggle="tooltip" title="Ketuk untuk melihat profil siswa">${nama}</a>`
                            );
                        }
                    },
                    "Kelas",
                    "Kompetensi Keahlian",
                    {
                        name: "Actions",
                        formatter: (cell, row) => {
                            const nis = row.cells[0].data;
                            const id = row.cells[4].data;
                            return gridjs.html(`
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <button class="btn btn-sm btn-primary regisBtn" data-nis="${nis}" data-bs-toggle="modal" data-bs-target="#registrasiModal">Registrasi</button>
                                        <button class="btn btn-sm btn-danger mutasiBtn" data-nis="${nis}" data-bs-toggle="modal" data-bs-target="#mutasiModal">Mutasi</button>
                                    </div>
                                </td>
                            `);
                        }
                    }
                ],
                server: {
                    url: '/siswa/data',
                    then: data => {
                        return data.map(siswa => [
                            siswa.nis,
                            siswa.nama_lengkap,
                            siswa.kdkelas,
                            siswa.kdkompetensi,
                            null
                        ]);
                    }
                },
                pagination: { limit: 20 },
                search: true,
                sort: true,
            }).render(document.getElementById("gridjs"));

            document.addEventListener("click", function (e) {
                if (e.target.classList.contains("regisBtn")) {
                    const nis = e.target.getAttribute("data-nis");

                    document.getElementById("regisNIS").value = nis;

                    // Ambil data registrasi siswa jika sudah ada
                    fetch(`/siswa/registrasi/${nis}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data) {
                                document.querySelector("select[name='jenis_pendaftaran']").value = data.jenis_pendaftaran || "Siswa Baru";
                                document.querySelector("input[name='tanggal_masuk']").value = data.tanggal_masuk || "";
                                document.querySelector("input[name='no_ijazah']").value = data.no_ijazah || "";
                            }
                        });
                }
            });

            document.addEventListener("click", function (e) {
                if (e.target.classList.contains("mutasiBtn")) {
                    const nis = e.target.getAttribute("data-nis");

                    document.getElementById("mutasiNIS").value = nis;

                    // Ambil data mutasi siswa jika sudah ada
                    fetch(`/siswa/mutasi/${nis}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data) {
                                document.querySelector("select[name='keluar_karena']").value = data.keluar_karena || "lulus";
                                document.querySelector("input[name='tanggal_keluar']").value = data.tanggal_keluar || "";
                                document.querySelector("input[name='notes']").value = data.notes || "";
                            }
                        });
                }
            });

            document.getElementById("noIjazah").addEventListener("input", function (e) {
                this.value = this.value.replace(/\D/g, ""); // Hapus semua karakter selain angka
            });
        });
    </script>
@endsection
