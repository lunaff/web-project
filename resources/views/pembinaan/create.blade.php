@extends('dashboard.master')
@section('title', 'Pembinaan')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pembinaan')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Add New Data Pembinaan</h4>
                            </div>                            
                            <div class="card-body">
                                <form action="{{ route('pembinaan.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="status">Status Pembinaan</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status_pembinaan" name="status">
                                            <option value="kasus baru" {{ old('status') == 'kasus baru' ? 'selected' : '' }}>Kasus Baru</option>
                                            <option value="dalam pembinaan" {{ old('status') == 'dalam pembinaan' ? 'selected' : '' }}>Dalam Pembinaan</option>
                                            <option value="kasus selesai" {{ old('status') == 'kasus selesai' ? 'selected' : '' }}>Kasus Selesai</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="tanggal_mulai">Tanggal Mulai Pembinaan</label>
                                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                                        @error('tanggal_mulai')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_selesai">Tanggal Selesai Pembinaan</label>
                                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                        @error('tanggal_selesai')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_kasus">Deskripsi Kasus</label>
                                        <input type="hidden" name="id_kasus" id="id_kasus" value="{{ old('id_kasus', $selectedKasus->id ?? '') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('id_kasus') is-invalid @enderror" placeholder="Pilih Kasus" id="deskripsi_kasus" name="deskripsi_kasus" value="{{ old('kasus', $selectedKasus->kasus ?? '') }}" readonly>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalKasus">Cari Kasus</a>
                                            </div>
                                        </div>
                                        @error('id_kasus')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="nama_guru">Nama Guru</label>
                                        <input type="hidden" name="id_guru" id="id_guru" value="{{ old('id_guru') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('id_guru') is-invalid @enderror" placeholder="Pilih Guru" id="nama_guru" name="nama_guru" value="{{ old('nama_guru') }}" readonly>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalGuru">Cari Guru</a>
                                            </div>
                                        </div>
                                        @error('id_guru')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="durasi">Durasi Pembinaan (hari)</label>
                                        <input type="number" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" value="{{ old('durasi') }}" readonly placeholder="Pilih Tanggal Mulai dan Tanggal Selesai untuk menghitung Durasi Pembinaan">
                                        @error('durasi')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="note">Catatan</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Catatan">{{ old('note') }}</textarea>
                                        @error('note')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('pembinaan.index') }}" class="btn btn-default">Batal</a>
                                    </div>

                                    <!-- Modal Pilih Guru -->
                                    <div class="modal fade" id="modalGuru" tabindex="-1" aria-labelledby="modalGuruLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalGuruLabel">Pilih Guru</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Guru</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($guru as $key => $g)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $g->nama_guru }}</td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-xs" onclick="pilihGuru('{{ $g->id }}', '{{ $g->nama_guru }}')" data-bs-toggle="modal">Pilih</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Pilih Kasus -->
                                    <div class="modal fade" id="modalKasus" tabindex="-1" aria-labelledby="modalKasusLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalKasusLabel">Pilih Kasus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama Siswa</th>
                                                                <th>Kasus</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($kasus as $key => $k)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $k->siswa->nama_lengkap ?? 'N/A' }}</td> <!-- Pastikan relasi siswa ada -->
                                                                    <td>{{ $k->kasus }}</td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-xs" onclick="pilihKasus('{{ $k->id }}', '{{ $k->kasus }}')" data-bs-toggle="modal">Pilih</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
    // Script untuk menghitung durasi pembinaan otomatis
    document.getElementById('tanggal_mulai').addEventListener('change', hitungDurasi);
    document.getElementById('tanggal_selesai').addEventListener('change', hitungDurasi);

    function hitungDurasi() {
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;

        if (mulai && selesai) {
            var start = new Date(mulai);
            var end = new Date(selesai);
            var timeDiff = end - start;
            var days = timeDiff / (1000 * 3600 * 24);
            if (days >= 0) {
                document.getElementById('durasi').value = days;
            }
        }
    }

    function pilihGuru(id, nama) {
        event.preventDefault();
        document.getElementById('id_guru').value = id;
        document.getElementById('nama_guru').value = nama;
        // $('#modalGuru').modal('hide'); // Menutup modal
    }

    // Fungsi untuk memilih Kasus
    function pilihKasus(id, kasus) {
        event.preventDefault();
        document.getElementById('id_kasus').value = id;
        document.getElementById('deskripsi_kasus').value = kasus;
        // $('#modalKasus').modal('hide'); // Menutup modal
    }
</script>
@endsection
