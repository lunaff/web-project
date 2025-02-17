@extends('dashboard.master')
@section('title', 'Pembinaan')
@section('message', 'Pembinaan')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pembinaan')
@section('create', route('pembinaan.create'))

@section('main')
    @if (Auth::user()->level == 'bk')
        @include('table2')
    @else
        @include('table1')
    @endif

    <!-- Modal untuk Edit Status & Note -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusModalLabel">Edit Status & Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editStatusForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="pembinaanId">
                        <div class="mb-3">
                            <label for="status">Status Pembinaan</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status_pembinaan" name="status">
                                <option value="kasus baru" {{ old('status') == 'kasus baru' ? 'selected' : '' }}>Kasus Baru</option>
                                <option value="dalam pembinaan" {{ old('status') == 'dalam pembinaan' ? 'selected' : '' }}>Dalam Pembinaan</option>
                                <option value="kasus selesai" {{ old('status') == 'kasus selesai' ? 'selected' : '' }}>Kasus Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="note">Catatan</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Catatan">{{ old('note') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('pembinaan.edit', ['pembinaan' => '__pembinaan_id__']) }}";
        const deleteUrl = "{{ route('pembinaan.destroy', ['pembinaan' => '__pembinaan_id__']) }}";

        new gridjs.Grid({
            columns: [
                // "No",
                "Kasus",
                "Guru",
                "Tanggal Mulai",
                "Tanggal Selesai",
                "Durasi",
                "Status",
                "Note",
                { name : "id", hidden: true },
                { name : "Status Pembinaan", hidden: true },
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                @if (Auth::user()->level != 'bk')
                                    <a href="${editUrlBase.replace('__pembinaan_id__', row.cells[7].data)}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="${deleteUrl.replace('__pembinaan_id__', row.cells[7].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this kelas?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="${row.cells[7].data}" data-status="${row.cells[8].data}" data-note="${row.cells[6].data}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    `)
                }
            ],
            server: {
                url: '/pembinaan/data',
                then: data => {
                    return data.map(pembinaan => [
                        // pembinaan.no,
                        pembinaan.kasus,
                        pembinaan.guru,
                        pembinaan.tanggal_mulai,
                        pembinaan.tanggal_selesai,
                        pembinaan.durasi + " hari",
                        gridjs.html(`<span class="badge bg-${pembinaan.status === 'Kasus Selesai' ? 'success' : 'warning'}">${pembinaan.status}</span>`),
                        pembinaan.note,             
                        pembinaan.id,
                        pembinaan.status_pembinaan,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));

        document.addEventListener("DOMContentLoaded", function () {
            var editStatusModal = document.getElementById('editStatusModal');

            editStatusModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Tombol yang membuka modal
                var pembinaanId = button.getAttribute('data-id');
                var status = button.getAttribute('data-status');
                console.log("Status diambil:", status);
                var note = button.getAttribute('data-note');

                var form = document.getElementById('editStatusForm');
                form.action = "{{ route('pembinaan.update', '__pembinaan_id__') }}".replace('__pembinaan_id__', pembinaanId);
                document.getElementById('pembinaanId').value = pembinaanId;

                // Pastikan status yang dipilih sesuai dengan option yang ada
                var statusDropdown = document.getElementById('status_pembinaan');
                for (let option of statusDropdown.options) {
                    if (option.value.toLowerCase() === status.toLowerCase()) {
                        option.selected = true;
                        break;
                    }
                }

                document.getElementById('note').value = note; // Isi default note
            });
        });
    </script>
@endsection
