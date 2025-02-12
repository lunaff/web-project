<style>
    .table-container {
        position: relative;
        margin: 20px;
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Data @yield('page')</h3>
                        <div class="group">
                            <a href="@yield('create')" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                    <div class="table-container">
                        <!-- Grid.js Tabel -->
                        <div id="gridjs"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
