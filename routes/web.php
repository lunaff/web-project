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
        Route::resource('siswa', SiswaController::class);

        // Import routes
        Route::post('user/import', [UserController::class, 'import'])->name('user.import');
        Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
        Route::post('kelas/import', [KelasController::class, 'import'])->name('kelas.import');
        Route::post('kompetensi-keahlian/import', [KompetensiKeahlianController::class, 'import'])->name('kompetensi-keahlian.import');
    });

    Route::middleware([CheckUserLevel::class . ':admin,osis'])->group(function () {
        Route::get('kegiatan/{kegiatan}/dokumentasi', [DokumentasiKegiatanController::class, 'index'])->name('kegiatan.dokumentasi');
        Route::get('kegiatan/{kegiatan}/upload', [DokumentasiKegiatanController::class, 'create'])->name('kegiatan.form');
        Route::post('kegiatan/{kegiatan}/upload', [DokumentasiKegiatanController::class, 'store'])->name('kegiatan.upload');
        Route::get('osis/prestasi', [DokumentasiPrestasiController::class, 'index'])->name('osis-prestasi.index');
        Route::get('prestasi/{prestasi}/dokumentasi', [DokumentasiPrestasiController::class, 'index'])->name('prestasi.dokumentasi');
        Route::get('prestasi/{prestasi}/upload', [DokumentasiPrestasiController::class, 'create'])->name('osis-prestasi.form');
        Route::post('prestasi/{prestasi}/upload', [DokumentasiPrestasiController::class, 'store'])->name('prestasi.upload');
    });

    // Routes yang membutuhkan login tetapi tidak terbatas oleh level user
    Route::resource('dashboard', DashboardController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('pembinaan', PembinaanController::class);
    Route::resource('pelanggaran', PelanggaranController::class);
    Route::resource('laporan-kasus', LaporanKasusController::class);
    Route::resource('kunjungan-rumah', KunjunganRumahController::class);
    Route::resource('calendar', CalendarController::class);

    // REPORTING
    Route::get('/report/laporan-kasus', [ReportController::class, 'getLaporanKasus']);
    Route::get('/report/top-kasus', [ReportController::class, 'topKasus']);
    Route::get('/report/prestasi-terbaru', [ReportController::class, 'getPrestasiTerbaru']);
});
