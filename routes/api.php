<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\RekapKehadiran;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Presensi;
use App\Models\Attendance;
use App\Http\Controllers\GuruController;

Route::get('/', function () {
    return view('guru.datasiswa');
});

Route::get('/2', function () {
    return view('guru.laporan');
});
Route::prefix('ortu')->group(function () {
    Route::get('/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/rekap', [OrtuController::class, 'rekap'])->name('ortu.rekap');
    Route::get('/pengumuman', [OrtuController::class, 'pengumuman'])->name('ortu.pengumuman');
    Route::get('/data-orang-tua', [OrtuController::class, 'getData']);
});
