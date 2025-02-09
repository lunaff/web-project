<style>
    .table-container {
        position: relative;
        margin: 20px;
    }

    #addButton {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        z-index: 9999; /* Pastikan tombol ada di atas grid */
    }

    #addButton:hover {
        background-color: #0056b3;
    }

    #gridjs {
        z-index: 1; /* Menurunkan z-index Grid.js supaya tombol di atasnya */
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>Data @yield('page')</h3>
                    </div>
                    <div class="table-container">
                        <!-- Tombol di bagian atas kanan -->
                        <a href="@yield('create')" id="addButton" class="btn btn-primary">Add New</a>

                        <!-- Grid.js Tabel -->
                        <div id="gridjs"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>