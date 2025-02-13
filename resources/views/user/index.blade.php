@extends('dashboard.master')
@section('title', 'User')
@section('message', 'User')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'User')
@section('create', route('user.create'))
@section('import', route('user.import'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('user.edit', ['user' => '__user_id__']) }}";
        const deleteUrl = "{{ route('user.destroy', ['user' => '__user_id__']) }}";  // Template route with placeholder

        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "Name",
                "Email",
                "Level",
                "Guru NIP",
                "Siswa NIS",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__user_id__', row.cells[5].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__user_id__', row.cells[5].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                url: '/user/data', // The URL to fetch user data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(user => [
                        user.name,
                        user.email,
                        user.level,
                        user.guru_nip,
                        user.siswa_nis,
                        user.id
                    ]);
                }
            },
            pagination: {
                limit: 20
            }, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection