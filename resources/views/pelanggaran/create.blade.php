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
                            <h4 class="card-title mb-0">Add New Data Pelanggaran</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pelanggaran.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                                    @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jenis">Jenis</label>
                                    <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                        <option value="" selected hidden>Pilih Jenis Pelanggaran</option>
                                        <option value="terlambat" @if(old('jenis')=='terlambat') selected @endif>Terlambat</option>
                                        <option value="perilaku" @if(old('jenis')=='perilaku') selected @endif>Perilaku</option>
                                        <option value="penampilan" @if(old('jenis')=='penampilan') selected @endif>Penampilan</option>
                                        <option value="asusila" @if(old('jenis')=='asusila') selected @endif>Asusila</option>
                                    </select>
                                    @error('jenis') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea rows="5" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                    @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Siswa Terlibat -->
                                <div class="mb-3">
                                    <label>Siswa Terlibat</label>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#siswaModal">
                                        Pilih Siswa
                                    </button>
                                    <div id="selectedSiswa" class="mt-2">
                                        @if(old('siswa_ids'))
                                            @foreach(old('siswa_ids') as $nis)
                                                @php $siswaObj = $siswa->where('nis', $nis)->first(); @endphp
                                                @if($siswaObj)
                                                    <span class="badge bg-primary me-1" data-nis="{{ $nis }}">{{ $siswaObj->nama_lengkap }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div id="selectedSiswaInputs">
                                        @if(old('siswa_ids'))
                                            @foreach(old('siswa_ids') as $nis)
                                                <input type="hidden" name="siswa_ids[]" value="{{ $nis }}">
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('siswa_ids') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bukti" class="form-label">Bukti (opsional)</label>
                                    <input type="file" id="bukti" name="bukti" class="form-control">
                                    @error('bukti') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sanksi">Sanksi</label>
                                    <input type="text" class="form-control @error('sanksi') is-invalid @enderror" id="sanksi" name="sanksi" value="{{ old('sanksi') }}">
                                    @error('sanksi') <span class="text-danger">{{ $message }}</span> @enderror
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

<!-- Modal untuk memilih siswa -->
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="siswaModalLabel">Pilih Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Pilih</th>
              <th>NIS</th>
              <th>Nama Lengkap</th>
            </tr>
          </thead>
          <tbody>
            @foreach($siswa as $s)
            <tr>
              <td><input type="checkbox" class="siswa-checkbox-modal" value="{{ $s->nis }}"></td>
              <td>{{ $s->nis }}</td>
              <td>{{ $s->nama_lengkap }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="saveSelectedSiswa()">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
function saveSelectedSiswa(){
    const selectedCheckboxes = document.querySelectorAll('.siswa-checkbox-modal:checked');
    const selectedSiswaContainer = document.getElementById('selectedSiswa');
    const selectedSiswaInputs = document.getElementById('selectedSiswaInputs');
    selectedSiswaContainer.innerHTML = '';
    selectedSiswaInputs.innerHTML = '';
    const siswaData = @json($siswa->keyBy('nis'));
    selectedCheckboxes.forEach(checkbox => {
        const nis = checkbox.value;
        const nama = siswaData[nis].nama_lengkap;
        selectedSiswaContainer.innerHTML += `<span class="badge bg-primary me-1" data-nis="${nis}">${nama}</span>`;
        selectedSiswaInputs.innerHTML += `<input type="hidden" name="siswa_ids[]" value="${nis}">`;
    });
    // Tutup modal
    var siswaModalEl = document.getElementById('siswaModal');
    var modal = bootstrap.Modal.getInstance(siswaModalEl);
    modal.hide();
}
</script>
@endsection
