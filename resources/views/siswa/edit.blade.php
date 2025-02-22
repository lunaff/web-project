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
                                        <label for="nipd">NIPD</label>
                                        <input type="number" class="form-control @error('nipd') is-invalid @enderror" id="nipd" placeholder="NIPD" name="nipd" value="{{ old('nipd', $siswa->nipd) }}">
                                        @error('nipd')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis Kelamin</label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jk" id="jkL" value="L"
                                                    @if(old('jk', $siswa->jk) == 'L') checked @endif>
                                                    <label class="form-check-label" for="jkL">Laki-laki</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jk" id="jkP" value="P"
                                                    @if(old('jk', $siswa->jk) == 'P') checked @endif>
                                                    <label class="form-check-label" for="jkP">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nisn">NISN</label>
                                        <input type="number" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="NISN" name="nisn" value="{{ old('nisn', $siswa->nisn) }}">
                                        @error('nisn')
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
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? date('Y-m-d', strtotime($siswa->tanggal_lahir)) : '') }}">
                                        @error('tanggal_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="NIK" name="nik" value="{{ old('nik', $siswa->nik) }}">
                                        @error('nik')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="agama">Agama</label>
                                        <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                                            <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Protestan" {{ old('agama', $siswa->agama) == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                            <option value="Buddha" {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Lainnya" {{ old('agama', $siswa->agama) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('agama')
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
                                        <label for="rt">RT</label>
                                        <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" placeholder="RT" name="rt" value="{{ old('rt', $siswa->rt) }}">
                                        @error('rt')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="rw">RW</label>
                                        <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" placeholder="RW" name="rw" value="{{ old('rw', $siswa->rw) }}">
                                        @error('rw')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" placeholder="Kelurahan" name="kelurahan" value="{{ old('kelurahan', $siswa->kelurahan) }}">
                                        @error('kelurahan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" placeholder="Kecamatan" name="kecamatan" value="{{ old('kecamatan', $siswa->kecamatan) }}">
                                        @error('kecamatan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" placeholder="Kode Pos" name="kode_pos" value="{{ old('kode_pos', $siswa->kode_pos) }}">
                                        @error('kode_pos')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="jenis_tinggal">Jenis Tinggal</label>
                                        <select class="form-control @error('jenis_tinggal') is-invalid @enderror" id="jenis_tinggal" name="jenis_tinggal">
                                            <option disabled>Pilih Jenis Tinggal</option>
                                            <option value="Asrama" {{ old('jenis_tinggal', $siswa->jenis_tinggal) == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                                            <option value="Bersama orang tua" {{ old('jenis_tinggal', $siswa->jenis_tinggal) == 'Bersama orang tua' ? 'selected' : '' }}>Bersama orang tua</option>
                                            <option value="Kost" {{ old('jenis_tinggal', $siswa->jenis_tinggal) == 'Kost' ? 'selected' : '' }}>Kost</option>
                                            <option value="Pesantren" {{ old('jenis_tinggal', $siswa->jenis_tinggal) == 'Pesantren' ? 'selected' : '' }}>Pesantren</option>
                                            <option value="Wali" {{ old('jenis_tinggal', $siswa->jenis_tinggal) == 'Wali' ? 'selected' : '' }}>Wali</option>
                                            <option value="Lainnya" {{ old('jenis_tinggal', $siswa->jenis_tinggal) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('jenis_tinggal')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="alat_transportasi">Alat Transportasi</label>
                                        <select class="form-control @error('alat_transportasi') is-invalid @enderror" id="alat_transportasi" name="alat_transportasi">
                                            <option value="">Pilih Transportasi</option>
                                            <option value="ojek" {{ old('alat_transportasi', $siswa->alat_transportasi) == 'ojek' ? 'selected' : '' }}>Ojek</option>
                                            <option value="sepeda motor" {{ old('alat_transportasi', $siswa->alat_transportasi) == 'sepeda motor' ? 'selected' : '' }}>Sepeda Motor</option>
                                            <option value="angkutan umum" {{ old('alat_transportasi', $siswa->alat_transportasi) == 'angkutan umum' ? 'selected' : '' }}>Angkutan Umum</option>
                                            <option value="jalan kaki" {{ old('alat_transportasi', $siswa->alat_transportasi) == 'jalan kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                                            <option value="mobil" {{ old('alat_transportasi', $siswa->alat_transportasi) == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                            <option value="antar jemput" {{ old('alat_transportasi', $siswa->alat_transportasi) == 'antar jemput' ? 'selected' : '' }}>Antar Jemput</option>
                                        </select>
                                        @error('alat_transportasi')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="no_hp">No HP</label>
                                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="No HP" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
                                        @error('no_hp')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email', $siswa->email) }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Penerima KPS</label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="penerima_kps" id="penerima_kps_ya" value="1"
                                                        {{ old('penerima_kps', $siswa->penerima_kps) == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="penerima_kps_ya">Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="penerima_kps" id="penerima_kps_tidak" value="0"
                                                        {{ old('penerima_kps', $siswa->penerima_kps) == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="penerima_kps_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('penerima_kps')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="no_kps">No KPS</label>
                                        <input type="text" class="form-control @error('no_kps') is-invalid @enderror" id="no_kps" placeholder="Nomor KPS" name="no_kps" value="{{ old('no_kps', $siswa->no_kps) }}">
                                        @error('no_kps')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <select class="form-control @error('kewarganegaraan') is-invalid @enderror" id="kewarganegaraan" name="kewarganegaraan">
                                            <option value="WNI" {{ old('kewarganegaraan', $siswa->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI</option>
                                            <option value="WNA" {{ old('kewarganegaraan', $siswa->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                                        </select>
                                        @error('kewarganegaraan')
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
                                        <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                                        <input type="date" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah', $siswa->tanggal_lahir_ayah ? date('Y-m-d', strtotime($siswa->tanggal_lahir_ayah)) : '') }}">
                                        @error('tanggal_lahir_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenjang_pendidikan_ayah">Jenjang Pendidikan Ayah</label>
                                        <select class="form-select @error('jenjang_pendidikan_ayah') is-invalid @enderror" id="jenjang_pendidikan_ayah" name="jenjang_pendidikan_ayah">
                                            <option selected disabled>Pilih Jenjang Pendidikan</option>
                                            @foreach(['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', 'lainnya'] as $pendidikan)
                                                <option value="{{ $pendidikan }}" {{ old('jenjang_pendidikan_ayah', $siswa->jenjang_pendidikan_ayah) == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenjang_pendidikan_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                        <select class="form-select @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                            <option selected disabled>Pilih Pekerjaan</option>
                                            @foreach(['Buruh','Karyawan BUMN','Karyawan Swasta','Pedagang Besar','Pedagang Kecil','Pensiunan','Petani','PNS/TNI/Polri','Sudah Meninggal','Tidak Bekerja','Wiraswasta','Wirausaha','Lainnya'] as $pekerjaan)
                                                <option value="{{ $pekerjaan }}" {{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) == $pekerjaan ? 'selected' : '' }}>{{ $pekerjaan }}</option>
                                            @endforeach
                                        </select>
                                        @error('pekerjaan_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                        <select class="form-select @error('penghasilan_ayah') is-invalid @enderror" id="penghasilan_ayah" name="penghasilan_ayah">
                                            <option selected disabled>Pilih Penghasilan</option>
                                            @foreach(['Kurang dari Rp. 500,000','Rp. 500,000 - Rp. 999,999','Rp. 1,000,000 - Rp. 1,999,999','Rp. 2,000,000 - Rp. 4,999,999','Rp. 5,000,000 - Rp. 20,000,000','Lebih dari Rp. 20,000,000','Tidak Berpenghasilan',] as $penghasilan)
                                                <option value="{{ $penghasilan }}" {{ old('penghasilan_ayah', $siswa->penghasilan_ayah) == $penghasilan ? 'selected' : '' }}>{{ $penghasilan }}</option>
                                            @endforeach
                                        </select>
                                        @error('penghasilan_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nik_ayah">NIK Ayah</label>
                                        <input type="number" class="form-control @error('nik_ayah') is-invalid @enderror" id="nik_ayah" 
                                            name="nik_ayah" placeholder="Masukkan 16 digit NIK" value="{{ old('nik_ayah', $siswa->nik_ayah) }}">
                                        @error('nik_ayah')
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
                                        <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                                        <input type="date" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu', $siswa->tanggal_lahir_ibu ? date('Y-m-d', strtotime($siswa->tanggal_lahir_ibu)) : '') }}">
                                        @error('tanggal_lahir_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenjang_pendidikan_ibu">Jenjang Pendidikan Ibu</label>
                                        <select class="form-select @error('jenjang_pendidikan_ibu') is-invalid @enderror" id="jenjang_pendidikan_ibu" name="jenjang_pendidikan_ibu">
                                            <option selected disabled>Pilih Jenjang Pendidikan</option>
                                            @foreach(['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', 'lainnya'] as $pendidikan)
                                                <option value="{{ $pendidikan }}" {{ old('jenjang_pendidikan_ibu', $siswa->jenjang_pendidikan_ibu) == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenjang_pendidikan_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                        <select class="form-select @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                            <option selected disabled>Pilih Pekerjaan</option>
                                            @foreach(['Buruh','Karyawan BUMN','Karyawan Swasta','Pedagang Besar','Pedagang Kecil','Pensiunan','Petani','PNS/TNI/Polri','Sudah Meninggal','Tidak Bekerja','Wiraswasta','Wirausaha','Lainnya'] as $pekerjaan)
                                                <option value="{{ $pekerjaan }}" {{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) == $pekerjaan ? 'selected' : '' }}>{{ $pekerjaan }}</option>
                                            @endforeach
                                        </select>
                                        @error('pekerjaan_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                        <select class="form-select @error('penghasilan_ibu') is-invalid @enderror" id="penghasilan_ibu" name="penghasilan_ibu">
                                            <option selected disabled>Pilih Penghasilan</option>
                                            @foreach(['Kurang dari Rp. 500,000','Rp. 500,000 - Rp. 999,999','Rp. 1,000,000 - Rp. 1,999,999','Rp. 2,000,000 - Rp. 4,999,999','Rp. 5,000,000 - Rp. 20,000,000','Lebih dari Rp. 20,000,000','Tidak Berpenghasilan',] as $penghasilan)
                                                <option value="{{ $penghasilan }}" {{ old('penghasilan_ibu', $siswa->penghasilan_ibu) == $penghasilan ? 'selected' : '' }}>{{ $penghasilan }}</option>
                                            @endforeach
                                        </select>
                                        @error('penghasilan_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nik_ibu">NIK Ibu</label>
                                        <input type="number" class="form-control @error('nik_ibu') is-invalid @enderror" id="nik_ibu" 
                                            name="nik_ibu" placeholder="Masukkan 16 digit NIK" value="{{ old('nik_ibu', $siswa->nik_ibu) }}">
                                        @error('nik_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_wali">Nama Wali</label>
                                        <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" 
                                            name="nama_wali" placeholder="Nama Wali" value="{{ old('nama_wali', $siswa->nama_wali) }}">
                                        @error('nama_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Tanggal Lahir Wali -->
                                    <div class="mb-3">
                                        <label for="tanggal_lahir_wali">Tanggal Lahir Wali</label>
                                        <input type="date" class="form-control @error('tanggal_lahir_wali') is-invalid @enderror" id="tanggal_lahir_wali"
                                            name="tanggal_lahir_wali" value="{{ old('tanggal_lahir_wali', $siswa->tanggal_lahir_wali ? date('Y-m-d', strtotime($siswa->tanggal_lahir_wali)) : '') }}">
                                        @error('tanggal_lahir_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Jenjang Pendidikan Wali -->
                                    <div class="mb-3">
                                        <label for="jenjang_pendidikan_wali">Jenjang Pendidikan Wali</label>
                                        <select class="form-select @error('jenjang_pendidikan_wali') is-invalid @enderror" id="jenjang_pendidikan_wali" name="jenjang_pendidikan_wali">
                                            <option selected disabled>Pilih Jenjang Pendidikan</option>
                                            @foreach(['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', 'lainnya'] as $pendidikan)
                                                <option value="{{ $pendidikan }}" {{ old('jenjang_pendidikan_wali', $siswa->jenjang_pendidikan_wali) == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenjang_pendidikan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Pekerjaan Wali -->
                                    <div class="mb-3">
                                        <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                        <select class="form-select @error('pekerjaan_wali') is-invalid @enderror" id="pekerjaan_wali" name="pekerjaan_wali">
                                            <option selected disabled>Pilih Pekerjaan</option>
                                            @foreach(['Buruh','Karyawan BUMN','Karyawan Swasta','Pedagang Besar','Pedagang Kecil','Pensiunan','Petani','PNS/TNI/Polri','Sudah Meninggal','Tidak Bekerja','Wiraswasta','Wirausaha','Lainnya'] as $pekerjaan)
                                                <option value="{{ $pekerjaan }}" {{ old('pekerjaan_wali', $siswa->pekerjaan_wali) == $pekerjaan ? 'selected' : '' }}>{{ $pekerjaan }}</option>
                                            @endforeach
                                        </select>
                                        @error('pekerjaan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Penghasilan Wali -->
                                    <div class="mb-3">
                                        <label for="penghasilan_wali">Penghasilan Wali</label>
                                        <select class="form-select @error('penghasilan_wali') is-invalid @enderror" id="penghasilan_wali" name="penghasilan_wali">
                                            <option selected disabled>Pilih Penghasilan</option>
                                            @foreach(['Kurang dari Rp. 500,000','Rp. 500,000 - Rp. 999,999','Rp. 1,000,000 - Rp. 1,999,999','Rp. 2,000,000 - Rp. 4,999,999','Rp. 5,000,000 - Rp. 20,000,000','Lebih dari Rp. 20,000,000','Tidak Berpenghasilan',] as $penghasilan)
                                                <option value="{{ $penghasilan }}" {{ old('penghasilan_wali',  $siswa->penghasilan_wali) == $penghasilan ? 'selected' : '' }}>{{ $penghasilan }}</option>
                                            @endforeach
                                        </select>
                                        @error('penghasilan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- NIK Wali -->
                                    <div class="mb-3">
                                        <label for="nik_wali">NIK Wali</label>
                                        <input type="number" class="form-control @error('nik_wali') is-invalid @enderror" id="nik_wali" 
                                            name="nik_wali" placeholder="Masukkan 16 digit NIK" value="{{ old('nik_wali',  $siswa->nik_wali) }}">
                                        @error('nik_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                    <div class="mb-3">
                                        <label for="no_ortu">No HP Orang Tua/Wali</label>
                                        <input type="number" class="form-control @error('no_ortu') is-invalid @enderror" id="no_ortu" placeholder="No Ortu" name="no_ortu" value="{{ old('no_ortu',  $siswa->no_ortu) }}">
                                        @error('no_ortu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_peserta_un">Nomor Peserta UN</label>
                                        <input type="text" class="form-control @error('no_peserta_un') is-invalid @enderror" id="no_peserta_un" 
                                            name="no_peserta_un" placeholder="Masukkan Nomor Peserta UN" value="{{ old('no_peserta_un', $siswa->no_peserta_un) }}">
                                        @error('no_peserta_un')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Nomor Seri Ijazah -->
                                    <div class="mb-3">
                                        <label for="no_seri_ijazah">Nomor Seri Ijazah</label>
                                        <input type="text" class="form-control @error('no_seri_ijazah') is-invalid @enderror" id="no_seri_ijazah" 
                                            name="no_seri_ijazah" placeholder="Masukkan Nomor Seri Ijazah" value="{{ old('no_seri_ijazah', $siswa->no_seri_ijazah) }}">
                                        @error('no_seri_ijazah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Penerima KIP -->
                                    <div class="mb-3">
                                        <label>Penerima KIP</label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="penerima_kip"
                                                        id="penerima_kip_ya" value="1" {{ old('penerima_kip', $siswa->penerima_kip) == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="penerima_kip_ya">Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="penerima_kip"
                                                        id="penerima_kip_tidak" value="0" {{ old('penerima_kip', $siswa->penerima_kip) == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="penerima_kip_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Nomor KIP -->
                                    <div class="mb-3">
                                        <label for="nomor_kip">Nomor KIP</label>
                                        <input type="text" class="form-control @error('nomor_kip') is-invalid @enderror" id="nomor_kip" 
                                            name="nomor_kip" placeholder="Masukkan Nomor KIP" value="{{ old('nomor_kip', $siswa->nomor_kip) }}">
                                        @error('nomor_kip')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Nama di KIP -->
                                    <div class="mb-3">
                                        <label for="nama_di_kip">Nama di KIP</label>
                                        <input type="text" class="form-control @error('nama_di_kip') is-invalid @enderror" id="nama_di_kip" 
                                            name="nama_di_kip" placeholder="Masukkan Nama Sesuai KIP" value="{{ old('nama_di_kip', $siswa->nama_di_kip) }}">
                                        @error('nama_di_kip')
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
                                        <label for="anak_keberapa">Anak Keberapa</label>
                                        <input type="number" class="form-control @error('anak_keberapa') is-invalid @enderror" id="anak_keberapa" 
                                            name="anak_keberapa" placeholder="Masukkan Urutan Anak" 
                                            value="{{ old('anak_keberapa', $siswa->anak_keberapa) }}">
                                        @error('anak_keberapa')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Lintang -->
                                    <div class="mb-3">
                                        <label for="lintang">Lintang</label>
                                        <input type="number" step="0.0000001" class="form-control @error('lintang') is-invalid @enderror" id="lintang" 
                                            name="lintang" placeholder="Masukkan Koordinat Lintang" 
                                            value="{{ old('lintang', $siswa->lintang) }}">
                                        @error('lintang')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Bujur -->
                                    <div class="mb-3">
                                        <label for="bujur">Bujur</label>
                                        <input type="number" step="0.0000001" class="form-control @error('bujur') is-invalid @enderror" id="bujur" 
                                            name="bujur" placeholder="Masukkan Koordinat Bujur" 
                                            value="{{ old('bujur', $siswa->bujur) }}">
                                        @error('bujur')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Nomor KK -->
                                    <div class="mb-3">
                                        <label for="no_kk">Nomor Kartu Keluarga (KK)</label>
                                        <input type="number" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" 
                                            name="no_kk" placeholder="Masukkan Nomor KK" 
                                            value="{{ old('no_kk', $siswa->no_kk) }}">
                                        @error('no_kk')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Berat Badan -->
                                    <div class="mb-3">
                                        <label for="berat_badan">Berat Badan (kg)</label>
                                        <input type="number" step="0.01" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" 
                                            name="berat_badan" placeholder="Masukkan Berat Badan" 
                                            value="{{ old('berat_badan', $siswa->berat_badan) }}">
                                        @error('berat_badan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Tinggi Badan -->
                                    <div class="mb-3">
                                        <label for="tinggi_badan">Tinggi Badan (cm)</label>
                                        <input type="number" step="0.01" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" 
                                            name="tinggi_badan" placeholder="Masukkan Tinggi Badan" 
                                            value="{{ old('tinggi_badan', $siswa->tinggi_badan) }}">
                                        @error('tinggi_badan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Jarak Rumah ke Sekolah -->
                                    <div class="mb-3">
                                        <label for="jarak_rmh_sklh">Jarak Rumah ke Sekolah (km)</label>
                                        <input type="number" step="0.001" class="form-control @error('jarak_rmh_sklh') is-invalid @enderror" id="jarak_rmh_sklh" 
                                            name="jarak_rmh_sklh" placeholder="Masukkan Jarak Rumah ke Sekolah" 
                                            value="{{ old('jarak_rmh_sklh', $siswa->jarak_rmh_sklh) }}">
                                        @error('jarak_rmh_sklh')
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