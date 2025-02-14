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

Route::get('/404', function () { return view('404'); })->name('404');

Route::get('/login', function () {
    return redirect('dashboard.dashboard');
})->middleware('auth');

// Route untuk login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware([CheckUserLevel::class . ':admin,operator'])->group(function () {
    // Route dashboard
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

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('pembinaan', PembinaanController::class);
    Route::resource('pelanggaran', PelanggaranController::class);
    Route::resource('laporan-kasus', LaporanKasusController::class);
    Route::resource('kunjungan-rumah', KunjunganRumahController::class);
});
