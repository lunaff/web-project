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
    @if (Auth::user()->role == 'bk')
        @include('table2')
    @else
        @include('table1')
    @endif
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
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
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
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
