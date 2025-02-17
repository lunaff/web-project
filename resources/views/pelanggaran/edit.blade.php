@extends('dashboard.master')
@section('title', 'Pelanggaran')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pelanggaran')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Edit Data Pelanggaran</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pelanggaran.update', $pelanggaran->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal"
                                            value="{{ old('tanggal', $pelanggaran->tanggal) }}">
                                        @error('tanggal')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis">Jenis</label>
                                        <select class="form-select @error('jenis') is-invalid @enderror" id="jenis"
                                            name="jenis">
                                            <option value="" selected hidden>Pilih Jenis Pelanggaran</option>
                                            <option value="terlambat" @if (old('jenis', $pelanggaran->jenis) == 'terlambat') selected @endif>
                                                Terlambat</option>
                                            <option value="perilaku" @if (old('jenis', $pelanggaran->jenis) == 'perilaku') selected @endif>
                                                Perilaku</option>
                                            <option value="penampilan" @if (old('jenis', $pelanggaran->jenis) == 'penampilan') selected @endif>
                                                Penampilan</option>
                                            <option value="asusila" @if (old('jenis', $pelanggaran->jenis) == 'asusila') selected @endif>
                                                Asusila</option>
                                        </select>
                                        @error('jenis')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea rows="5" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                            name="keterangan">{{ old('keterangan', $pelanggaran->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Siswa Terlibat -->
                                    <div class="mb-3">
                                        <label for="kdsiswa">Nama Siswa</label>
                                        <input type="hidden" name="siswa_ids" id="kdsiswa"
                                            value="{{ old('siswa_ids', isset($pelanggaran) ? implode(',', $pelanggaran->siswa->pluck('nis')->toArray()) : '') }}">

                                        <div class="input-group">
                                            <div class="form-control d-flex flex-wrap align-items-center"
                                                id="nama_siswa_container" style="min-height: 38px;">
                                                @php
                                                    $selectedSiswa = old('siswa_ids')
                                                        ? explode(',', old('siswa_ids'))
                                                        : (isset($pelanggaran)
                                                            ? $pelanggaran->siswa->pluck('nis')->toArray()
                                                            : []);
                                                @endphp

                                                @foreach ($selectedSiswa as $nis)
                                                    @php
                                                        $siswaData = $siswa->where('nis', $nis)->first();
                                                    @endphp
                                                    @if ($siswaData)
                                                        <span class="badge bg-primary me-1 siswa-badge"
                                                            data-nis="{{ $nis }}">
                                                            {{ $siswaData->nama_lengkap }}
                                                            <button type="button" class="btn-close btn-sm btn-remove-siswa"
                                                                data-nis="{{ $nis }}"></button>
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalSiswa">
                                                    Cari Siswa
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="bukti" class="form-label">Bukti (opsional)</label>
                                        <input type="file" id="bukti" name="bukti" class="form-control">
                                        @if ($pelanggaran->bukti)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $pelanggaran->bukti) }}"
                                                    target="_blank">Lihat Bukti</a>
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="checkbox" name="hapus_bukti"
                                                        id="hapusBukti">
                                                    <label class="form-check-label" for="hapusBukti">Hapus Bukti</label>
                                                </div>
                                            </div>
                                        @endif
                                        @error('bukti')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="sanksi">Sanksi</label>
                                        <input type="text" class="form-control @error('sanksi') is-invalid @enderror"
                                            id="sanksi" name="sanksi"
                                            value="{{ old('sanksi', $pelanggaran->sanksi) }}">
                                        @error('sanksi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('pelanggaran.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Siswa -->
    <div class="modal fade" id="modalSiswa" tabindex="-1" aria-labelledby="modalSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSiswaLabel">Pilih Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="searchSiswa" class="form-control mb-3" placeholder="Cari siswa...">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                            </tr>
                        </thead>
                        <tbody id="siswaTableBody">
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="siswa-checkbox" value="{{ $s->nis }}"
                                            data-nama="{{ $s->nama_lengkap }}"
                                            @if (in_array($s->nis, $selectedSiswa)) checked @endif>
                                    </td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nama_lengkap }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSimpanSiswa">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectedSiswa = [];

            function loadSelectedSiswa() {
                let siswaInput = document.getElementById("kdsiswa").value;
                let siswaArray = siswaInput ? siswaInput.split(",") : [];

                selectedSiswa = siswaArray.map(nis => {
                    let nama = document.querySelector(`.siswa-checkbox[value="${nis}"]`)?.getAttribute(
                        "data-nama") || "";
                    return {
                        nis,
                        nama
                    };
                });

                updateSiswaContainer();
            }

            function updateSiswaContainer() {
                let container = document.getElementById("nama_siswa_container");
                container.innerHTML = "";
                selectedSiswa.forEach(({
                    nis,
                    nama
                }) => {
                    let badgeHtml = `
                    <span class="badge bg-primary me-1 siswa-badge" data-nis="${nis}">
                        ${nama}
                        <button type="button" class="btn-close btn-sm btn-remove-siswa" data-nis="${nis}"></button>
                    </span>
                `;
                    container.innerHTML += badgeHtml;
                });

                document.getElementById("kdsiswa").value = selectedSiswa.map(s => s.nis).join(",");
            }

            loadSelectedSiswa();

            document.getElementById("btnSimpanSiswa").addEventListener("click", function() {
                selectedSiswa = [];
                document.querySelectorAll("#siswaTableBody .siswa-checkbox:checked").forEach(checkbox => {
                    let nis = checkbox.value;
                    let nama = checkbox.getAttribute("data-nama");
                    selectedSiswa.push({
                        nis,
                        nama
                    });
                });

                updateSiswaContainer();
                let modal = bootstrap.Modal.getInstance(document.getElementById('modalSiswa'));
                modal.hide();
            });

            document.getElementById("nama_siswa_container").addEventListener("click", function(e) {
                if (e.target.classList.contains("btn-remove-siswa")) {
                    let nis = e.target.getAttribute("data-nis");
                    selectedSiswa = selectedSiswa.filter(s => s.nis !== nis);

                    let checkbox = document.querySelector(`.siswa-checkbox[value="${nis}"]`);
                    if (checkbox) checkbox.checked = false;

                    updateSiswaContainer();
                }
            });

            document.getElementById("searchSiswa").addEventListener("keyup", function() {
                let searchText = this.value.toLowerCase();
                document.querySelectorAll("#siswaTableBody tr").forEach(row => {
                    let nama = row.cells[2].textContent.toLowerCase();
                    let nis = row.cells[1].textContent.toLowerCase();
                    row.style.display = nama.includes(searchText) || nis.includes(searchText) ? "" :
                        "none";
                });
            });

            document.getElementById("selectAll").addEventListener("change", function() {
                let isChecked = this.checked;
                document.querySelectorAll(".siswa-checkbox").forEach(cb => cb.checked = isChecked);
            });

            function syncModalCheckboxes() {
                document.querySelectorAll(".siswa-checkbox").forEach(checkbox => {
                    let nis = checkbox.value;
                    checkbox.checked = selectedSiswa.some(s => s.nis === nis);
                });
            }

            document.getElementById("modalSiswa").addEventListener("shown.bs.modal", function() {
                syncModalCheckboxes();
            });

        });
    </script>
@endsection
