@extends('dashboard.master')
@section('title', 'Kompetensi Keahlian')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kompetensi Keahlian')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Add New Data Kompetensi Keahlian</h4>
                            </div>                            
                            <div class="card-body">
                                <form action="{{ route('kompetensi-keahlian.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                                        <input type="text" class="form-control 
                                    @error('kompetensi_keahlian') is-invalid @enderror" id="kompetensi_keahlian" placeholder="Kompetensi Keahlian" name="kompetensi_keahlian" value="{{old('kompetensi_keahlian')}}">
                                        @error('kompetensi_keahlian') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="guru_nip">Kepala Program</label>
                                        <input type="hidden" name="guru_nip" id="guru_nip" value="{{ old('guru_nip') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" placeholder="Nama Kepala Program" id="nama_guru" name="nama_guru" aria-label="nama_guru" value="{{ old('nama_guru') }}" aria-describedby="cari" readonly>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                                    Cari Guru
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}">
                                        @error('tahun_ajaran')
                                        <span class="text danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Modal GURU -->
                                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel1">Pencarian Guru</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-hover table-bordered table-stripped" id="example2">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama</th>
                                                                <th>NIP</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($guru as $key => $k)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td id="guru_nip{{ $key + 1 }}">{{ $k->nama_guru }}</td> <!-- Perbaiki di sini -->
                                                                <td id="guru_nip{{ $key + 1 }}">{{ $k->nip }}</td> <!-- Perbaiki di sini -->
                                                                <td>
                                                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilih1('{{ $k->nama_guru }}', '{{ $k->nip }}')" data-bs-toggle="modal">
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

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                        <a href="{{ route('kompetensi-keahlian.index') }}" class="btn btn-danger">Batal</a>
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

        function pilih1(nama_guru, nip) {
            document.getElementById('guru_nip').value = nip; // Perbaiki variabel nip
            document.getElementById('nama_guru').value = nama_guru;
            // $('#staticBackdrop1').modal('hide');
        }
    </script>
@endsection