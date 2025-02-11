@extends('dashboard.master')
@section('title', 'User')

@section('nav')
@include('dashboard.header')
@include('dashboard.nav')
@endsection

@section('page', 'User')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Edit Data User</h4>
                        </div>
                        <div class="card-body">
                            <!-- <p>Debug Level: {{ old('level', $user->level) }}</p> -->
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputName">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="exampleInputName" placeholder="Nama lengkap" name="name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                    <span class="textdanger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail">Email
                                        address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="exampleInputEmail" placeholder="Masukkan Email" name="email"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                    <span class="textdanger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="exampleInputPassword" placeholder="Isi jika ingin mengubah password" name="password">
                                    @error('password')
                                    <span class="textdanger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword">Konfirmasi
                                        Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword"
                                        placeholder="Konfirmasi Password Baru" name="password_confirmation">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputlevel">Level</label>
                                    <select class="form-control @error('level') is-invalid @enderror"
                                        id="exampleInputlevel" name="level" onchange="toggleFields()">
                                        <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="osis" {{ old('level', $user->level) == 'osis' ? 'selected' : '' }}>OSIS</option>
                                        <option value="bk" {{ old('level', $user->level) == 'bk' ? 'selected' : '' }}>BK</option>
                                        <option value="kepsek" {{ old('level', $user->level) == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                                        <option value="kesiswaan" {{ old('level', $user->level) == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                                        <option value="operator" {{ old('level', $user->level) == 'operator' ? 'selected' : '' }}>Operator</option>
                                    </select>
                                    @error('level')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Guru Field -->
                                <div id="guruField" class="mb-3" style="display: none;">
                                    <label for="guru_nip">Guru</label>
                                    <input type="hidden" name="guru_nip" id="guru_nip" value="{{ old('guru_nip') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" placeholder="Nama Guru" id="nama_guru" name="nama_guru" value="{{ old('guru_nip', $user->guru_nip) }}" readonly>
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                                Cari Guru
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Siswa Field -->
                                <div id="siswaField" class="mb-3" style="display: none;">
                                    <label for="siswa_nis">Siswa</label>
                                    <input type="hidden" name="siswa_nis" id="siswa_nis" value="{{ old('siswa_nis') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Nama Siswa" id="nama_lengkap" name="nama_lengkap" value="{{ old('siswa_nis', $user->siswa_nis) }}" readonly>
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                                Cari Siswa
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-danger">
                                Batal
                            </a>
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

                        <!-- Modal SISWA -->
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel2">Pencarian Siswa</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-hover table-bordered table-stripped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>NIS</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $key => $k)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td id="siswa_nis{{ $key + 1 }}">{{ $k->nama_lengkap }}</td> <!-- Perbaiki di sini -->
                                                    <td id="siswa_nis{{ $key + 1 }}">{{ $k->nis }}</td> <!-- Perbaiki di sini -->
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-xs" onclick="pilih2('{{ $k->nama_lengkap }}', '{{ $k->nis }}')" data-bs-toggle="modal">
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
                        </form>
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

        function pilih2(nama_lengkap, nis) {
            document.getElementById('siswa_nis').value = nis; // Perbaiki variabel nip
            document.getElementById('nama_lengkap').value = nama_lengkap;
            // $('#staticBackdrop1').modal('hide');
        }

        // Jalankan saat halaman dimuat agar tetap terbuka jika ada old() di form
        document.addEventListener("DOMContentLoaded", function() {
            toggleFields();
        });

        function toggleFields() {
            var level = document.getElementById("exampleInputlevel").value;
            var guruField = document.getElementById("guruField");
            var siswaField = document.getElementById("siswaField");

            // Reset semua dulu
            guruField.style.display = "none";
            siswaField.style.display = "none";

            // Jika level adalah "kesiswaan" atau "bk", tampilkan field guru
            if (level === "kesiswaan" || level === "bk") {
                guruField.style.display = "block";
            }
            // Jika level adalah "osis", tampilkan field siswa
            else if (level === "osis") {
                siswaField.style.display = "block";
            }
        }
    </script>
@endsection