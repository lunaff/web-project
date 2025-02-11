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

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
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
                        <a href="/user/${row.cells[1].data}/edit" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="deleteData('${row.cells[1].data}')">
                            <i class="fa fa-trash"></i>
                        </button>
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
                        null
                    ]);
                }
            },
            pagination: {
                limit: 20
            }, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));

        function deleteData(email) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch(`/user/${email}/delete`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("User deleted successfully!");
                        location.reload();
                    } else {
                        alert("Failed to delete user.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        }
    </script>
@endsection