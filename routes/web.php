<?php

use App\Models\Prestasi;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserLevel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KompetensiKeahlianController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\LaporanKasusController;
use App\Http\Controllers\KunjunganRumahController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\TrackRecordController;
use App\Http\Controllers\RegistrasiMutasiController;

use App\Http\Controllers\Dokumentasi\DokumentasiKegiatanController;
use App\Http\Controllers\Dokumentasi\DokumentasiPrestasiController;
use App\Http\Controllers\ReportController;

Route::get('/404', function () { return view('404'); })->name('404');

Route::get('/login', function () {
    return redirect('dashboard.dashboard');
})->middleware('auth');

// Route untuk login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Middleware untuk route yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // Middleware yang sudah ada
    Route::middleware([CheckUserLevel::class . ':admin,operator'])->group(function () {
        // Route dashboard dan lainnya
        Route::resource('user', UserController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('kompetensi-keahlian', KompetensiKeahlianController::class);
        Route::resource('kelas', KelasController::class);

        // Import routes
        Route::post('user/import', [UserController::class, 'import'])->name('user.import');
        Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
        Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
        Route::post('kelas/import', [KelasController::class, 'import'])->name('kelas.import');
        Route::post('kompetensi-keahlian/import', [KompetensiKeahlianController::class, 'import'])->name('kompetensi-keahlian.import');

        //Export routes
        Route::get('export-user', [UserController::class, 'exportUser'])->name('export.user');
        Route::get('export-siswa', [SiswaController::class, 'exportSiswa'])->name('export.siswa');
        Route::get('export-guru', [GuruController::class, 'exportGuru'])->name('export.guru');
        Route::get('export-kompetensi-keahlian', [KompetensiKeahlianController::class, 'exportKompK'])->name('export.kompetensi-keahlian');
        Route::get('export-kelas', [KelasController::class, 'exportKelas'])->name('export.kelas');

    });

    Route::middleware([CheckUserLevel::class . ':admin,osis'])->group(function () {
        Route::get('kegiatan/{kegiatan}/dokumentasi', [DokumentasiKegiatanController::class, 'index'])->name('kegiatan.dokumentasi');
        Route::get('kegiatan/{kegiatan}/upload', [DokumentasiKegiatanController::class, 'create'])->name('kegiatan.form');
        Route::post('kegiatan/{kegiatan}/upload', [DokumentasiKegiatanController::class, 'store'])->name('kegiatan.upload');
        Route::get('prestasi/{prestasi}/dokumentasi', [DokumentasiPrestasiController::class, 'index'])->name('prestasi.dokumentasi');
        Route::get('prestasi/{prestasi}/upload', [DokumentasiPrestasiController::class, 'create'])->name('prestasi.form');
        Route::post('prestasi/{prestasi}/upload', [DokumentasiPrestasiController::class, 'store'])->name('prestasi.upload');
    });

    Route::middleware([CheckUserLevel::class . ':admin,operator,kesiswaan'])->group(function () {
        Route::prefix('siswa')->group(function () {
            Route::get('registrasi-mutasi', [RegistrasiMutasiController::class, 'index'])->name('siswa.registrasi.mutasi');
            Route::get('registrasi/{nis}', [SiswaController::class, 'getRegistrasi']);
            Route::put('registrasi', [RegistrasiMutasiController::class, 'registrasi'])->name('siswa.registrasi');
            Route::get('mutasi/{nis}', [SiswaController::class, 'getMutasi']);
            Route::put('mutasi', [RegistrasiMutasiController::class, 'mutasi'])->name('siswa.mutasi');
        });        
        Route::resource('siswa', SiswaController::class);
    });

    // Routes yang membutuhkan login tetapi tidak terbatas oleh level user
    Route::resource('dashboard', DashboardController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('pembinaan', PembinaanController::class);
    Route::resource('pelanggaran', PelanggaranController::class);
    Route::resource('laporan-kasus', LaporanKasusController::class)->parameters([
        'laporan-kasus' => 'laporan_kasus'
    ]);
    Route::resource('kunjungan-rumah', KunjunganRumahController::class);
    Route::resource('calendar', CalendarController::class);
    Route::get('/track-record/{nis}', [TrackRecordController::class, 'index'])->name('track-record.index');

    // REPORTING
    Route::get('/report/laporan-kasus', [ReportController::class, 'getLaporanKasus']);
    Route::get('/report/top-kasus', [ReportController::class, 'topKasus']);
    Route::get('/report/prestasi-terbaru', [ReportController::class, 'getPrestasiTerbaru']);
    Route::get('/report/prestasi', [ReportController::class, 'getPrestasiData']);
    Route::get('/report/jumlah-siswa', [ReportController::class, 'getJumlahSiswa']);
    Route::get('/report/pembinaan', [ReportController::class, 'getJumlahPembinaan']);
    Route::get('/report/pelanggaran', [ReportController::class, 'getJumlahPelanggaran']);
    Route::get('/report/upcoming-kegiatan', [ReportController::class, 'getUpcomingKegiatan']);
});
