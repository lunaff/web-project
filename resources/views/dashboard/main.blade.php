<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Laporan Kasus Tahun 
                                <span id="tahun-terpilih-container">
                                    <select id="filter-tahun" class="form-select border-0 d-inline w-auto">
                                        <!-- JavaScript akan mengisi opsi tahun -->
                                    </select>
                                </span>
                            </h5>
                            <div id="chart-laporan-kasus"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Kasus Terbanyak Bulan Ini</h5>
                                    </div>
                                </div>

                                <div class="mx-n4" data-simplebar style="max-height: 421px;">
                                    <div id="top-kasus-list">
                                        <div class="text-center p-3">Loading...</div> <!-- Placeholder saat loading -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Prestasi Terbaru</h5>
                            <div class="mx-n4" data-simplebar style="max-height: 400px;">
                                <div id="list-prestasi">
                                    <!-- Data prestasi akan dimasukkan dengan JavaScript -->
                                    <div class="text-center p-3">Loading...</div> <!-- Placeholder saat loading -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © webadmin.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://Themesdesign.com/" target="_blank" class="text-reset">Themesdesign</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->