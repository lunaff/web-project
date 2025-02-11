<form action="{{ route('pembinaan.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="tanggal_mulai">Tanggal Mulai Pembinaan</label>
        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
        @error('tanggal_mulai')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="tanggal_selesai">Tanggal Selesai Pembinaan</label>
        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
        @error('tanggal_selesai')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="deskripsi_kasus">Deskripsi Kasus</label>
        <input type="hidden" name="id_kasus" id="id_kasus" value="{{ old('id_kasus') }}">
        <div class="input-group">
            <input type="text" class="form-control @error('id_kasus') is-invalid @enderror" placeholder="Pilih Kasus" id="deskripsi_kasus" name="deskripsi_kasus" value="{{ old('deskripsi_kasus') }}" readonly>
            <div class="input-group-append">
                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalKasus">Cari Kasus</a>
            </div>
        </div>
        @error('id_kasus')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    

    <div class="form-group">
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
    

    <div class="form-group">
        <label for="durasi">Durasi Pembinaan (hari)</label>
        <input type="number" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" value="{{ old('durasi') }}" readonly>
        @error('durasi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status Pembinaan</label>
        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        @error('status')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="note">Catatan</label>
        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note') }}</textarea>
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
                                        <a href="#" class="btn btn-primary btn-xs" onclick="pilihGuru('{{ $g->id }}', '{{ $g->nama }}')">Pilih</a>
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
                                <th>Kasus</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kasus as $key => $k)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $k->kasus }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-xs" onclick="pilihKasus('{{ $k->id }}', '{{ $k->deskripsi }}')">Pilih</a>
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
        document.getElementById('id_guru').value = id;
        document.getElementById('nama_guru').value = nama;
        $('#modalGuru').modal('hide'); // Menutup modal
    }

    // Fungsi untuk memilih Kasus
    function pilihKasus(id, deskripsi) {
        document.getElementById('id_kasus').value = id;
        document.getElementById('deskripsi_kasus').value = deskripsi;
        $('#modalKasus').modal('hide'); // Menutup modal
    }
</script>

