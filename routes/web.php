<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\TimesheetController;

/*
|--------------------------------------------------------------------------
| Public Routes (Auth)
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:web')->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // --- Pegawai ---
    Route::get('/pegawai/{pegawai}/download-dokumen', [PegawaiController::class, 'downloadDokumen'])
        ->name('pegawai.download.dokumen');
    Route::resource('pegawai', PegawaiController::class);
    
    // --- Barang ---
    Route::get('/barang/print', [BarangController::class, 'print'])->name('barang.print');
    Route::resource('barang', BarangController::class);

    // --- Barang Masuk ---
    Route::get('/barang_masuk/print', [BarangMasukController::class, 'print'])->name('barang_masuk.print');
    Route::resource('barang_masuk', BarangMasukController::class);

    // --- Barang Keluar ---
    Route::get('/barang_keluar/print', [BarangKeluarController::class, 'print'])->name('barang_keluar.print');
    Route::resource('barang_keluar', BarangKeluarController::class);

    // --- Absensi & Timesheet ---
    Route::resource('absensi', AbsensiController::class);

    Route::get('timesheet', [TimesheetController::class, 'index'])->name('timesheet.index');
    Route::get('timesheet/{id_pegawai}/detail', [TimesheetController::class, 'show'])->name('timesheet.show');
});
