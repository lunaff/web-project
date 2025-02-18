<style>
    .table-container {
        position: relative;
        margin: 20px;
    }

    #gridjs {
        z-index: 1;
        /* Menurunkan z-index Grid.js supaya tombol di atasnya */
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Data @yield('page')</h3>
                        <div class="d-flex gap-1">
                            <a href="@yield('create')" class="btn btn-primary">Add New</a>
                            <form id="importForm" action="@yield('import')" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" id="fileInput" required style="display: none;" onchange="submitForm()">
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('fileInput').click();">
                                    Import
                                </button>
                            </form>
                            <!-- Export Form -->
                            <form id="exportForm" action="@yield('export')" method="GET">
                                @csrf
                                <button type="button" class="btn btn-info" onclick="exportData()">
                                    Template Import
                                </button>
                            </form>
                            
                            <!-- Hidden Export Link -->
                            <a href="@yield('export')" id="exportLink" style="display: none;"></a>
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

<script>
    function submitForm() {
        document.getElementById("importForm").submit();
    }
    function exportData() {
        document.getElementById("exportLink").click(); // Trigger the hidden link click
    }
</script>