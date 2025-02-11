@extends('dashboard.master')
@section('title', 'Siswa')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Siswa')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Edit Data Siswa</h4>
                            </div>                            
                            <div class="card-body">
                                <form action="{{ route('siswa.update', $siswa) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nis">NIS</label>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" placeholder="NIS" name="nis" value="{{ old('nis', $siswa->nis) }}">
                                        @error('nis')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kdkompetensi">Kompetensi Keahlian</label>
                                        <input type="hidden" name="kdkompetensi" id="kdkompetensi" value="{{ old('kdkompetensi') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian" aria-label="kompetensi_keahlian" value="{{ old('kompetensi_keahlian', optional($siswa->fkompetensi)->kompetensi_keahlian) }}" aria-describedby="cari" readonly>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Cari Kompetensi Keahlian
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kdkelas">Kelas</label>
                                        <input type="hidden" name="kdkelas" id="kdkelas" value="{{ old('kdkelas') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" placeholder="Kelas" id="kelas" name="kelas" aria-label="kelas" value="{{ old('kelas', optional($siswa->fkelas)->kelas) }}" aria-describedby="cari" readonly>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                                    Cari Kelas
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}">
                                        @error('nama_lengkap')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" placeholder="Nama Ayah" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}">
                                        @error('nama_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" placeholder="Nama Ibu" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}">
                                        @error('nama_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                                        @error('tempat_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Tempat Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}">
                                        @error('tanggal_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat">{{ old('alamat', $siswa->alamat) }}</textarea>
                                        @error('alamat')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="agama">Agama</label>
                                        <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                                            <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Protestan" {{ old('agama', $siswa->agama) == 'Protestan' ? 'selected' : '' }}>Protestan
                                            </option>
                                            <option value="Buddha" {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Lainnya" {{ old('agama', $siswa->agama) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('agama')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <select class="form-control @error('kewarganegaraan') is-invalid @enderror" id="kewarganegaraan" name="kewarganegaraan">
                                            <option value="WNI" {{ old('kewarganegaraan', $siswa->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI
                                            </option>
                                            <option value="WNA" {{ old('kewarganegaraan', $siswa->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA
                                            </option>
                                        </select>
                                        @error('kewarganegaraan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="no_hp">No HP</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="No HP" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
                                        @error('no_hp')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Email</label></label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email', $siswa->email) }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nisn">NISN</label>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="NISN" name="nisn" value="{{ old('nisn', $siswa->nisn) }}">
                                        @error('nisn')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun_masuk">Tahun Masuk</label>
                                        <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk" placeholder="Tahun Masuk" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}">
                                        @error('tahun_masuk')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat_ortu">Alamat Ortu</label>
                                        <textarea class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu" placeholder="Alamat Ortu">{{ old('alamat_ortu', $siswa->alamat_ortu) }}</textarea>
                                        @error('alamat_ortu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_ortu">No Ortu</label>
                                        <input type="text" class="form-control @error('no_ortu') is-invalid @enderror" id="no_ortu" placeholder="No Ortu" name="no_ortu" value="{{ old('no_ortu', $siswa->no_ortu) }}">
                                        @error('no_ortu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_sekolah_asal">Nama Sekolah Asal</label>
                                        <input type="text" class="form-control @error('nama_sekolah_asal') is-invalid @enderror" id="nama_sekolah_asal" placeholder="Nama Sekolah Asal" name="nama_sekolah_asal" value="{{ old('nama_sekolah_asal', $siswa->nama_sekolah_asal) }}">
                                        @error('nama_sekolah_asal')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat_sekolah">Alamat Sekolah</label>
                                        <textarea class="form-control @error('alamat_sekolah') is-invalid @enderror" id="alamat_sekolah" name="alamat_sekolah" placeholder="Alamat Sekolah">{{ old('alamat_sekolah', $siswa->alamat_sekolah) }}</textarea>
                                        @error('alamat_sekolah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun_lulus">Tahun Lulus</label>
                                        <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" placeholder="Tahun Lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $siswa->tahun_lulus) }}">
                                        @error('tahun_lulus')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="riwayat_penyakit">Riwayat Penyakit</label>
                                        <input type="text" class="form-control @error('riwayat_penyakit') is-invalid @enderror" id="riwayat_penyakit" placeholder="Riwayat Penyakit" name="riwayat_penyakit" value="{{ old('riwayat_penyakit', $siswa->riwayat_penyakit) }}">
                                        @error('riwayat_penyakit')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="alergi">Alergi</label>
                                        <input type="text" class="form-control @error('alergi') is-invalid @enderror" id="alergi" placeholder="Alergi" name="alergi" value="{{ old('alergi', $siswa->alergi) }}">
                                        @error('alergi')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="prestasi_akademik">Prestasi Akademik</label>
                                        <input type="text" class="form-control @error('prestasi_akademik') is-invalid @enderror" id="prestasi_akademik" placeholder="Prestasi Akademik" name="prestasi_akademik" value="{{ old('prestasi_akademik', $siswa->prestasi_akademik) }}">
                                        @error('prestasi_akademik')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="prestasi_non_akademik">Prestasi Non Akademik</label>
                                        <input type="text" class="form-control @error('prestasi_non_akademik') is-invalid @enderror" id="prestasi_non_akademik" placeholder="Prestasi Non Akademik" name="prestasi_non_akademik" value="{{ old('prestasi_non_akademik', $siswa->prestasi_non_akademik) }}">
                                        @error('prestasi_non_akademik')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="ekstrakurikuler">Ekstrakurikuler</label>
                                        <input type="text" class="form-control @error('ekstrakurikuler') is-invalid @enderror" id="ekstrakurikuler" placeholder="Ekstrakurikuler" name="ekstrakurikuler" value="{{ old('ekstrakurikuler', $siswa->ekstrakurikuler) }}">
                                        @error('ekstrakurikuler')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="biografi">Biografi</label>
                                        <textarea class="form-control @error('biografi') is-invalid @enderror" id="biografi" name="biografi" placeholder="Biografi">{{ old('biografi', $siswa->biografi) }}</textarea>
                                        @error('biografi')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Modal KOMPETENSI -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Kompetensi Keahlian</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-hover table-bordered table-stripped" id="example2">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Kompetensi Keahlian</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($kompetensi as $key => $k)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td id="kdkompetensi{{ $key + 1 }}">{{ $k->kompetensi_keahlian }}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilih('{{ $k->id }}', '{{ $k->kompetensi_keahlian }}')" data-bs-toggle="modal">
                                                                        Pilih
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <!-- Modal KELAS -->
                                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Kelas</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-hover table-bordered table-stripped" id="example2">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Kelas</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($kelas as $key => $k)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td id="kdkelas{{ $key + 1 }}">{{ $k->kelas }}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilih1('{{ $k->id }}', '{{ $k->kelas }}')" data-bs-toggle="modal">
                                                                        Pilih
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('siswa.index') }}" class="btn btn-default">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function pilih(id, kompetensi_keahlian) {
            document.getElementById('kdkompetensi').value = id;
            document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian;
            // $('#staticBackdrop').modal('hide');
        }

        function pilih1(id, kelas) {
            document.getElementById('kdkelas').value = id;
            document.getElementById('kelas').value = kelas;
            // $('#staticBackdrop1').modal('hide');
        }
    </script>
@endsection