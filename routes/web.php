<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\RekapKehadiran;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('guru.datasiswa');
});
Route::get('/1', function () {
    return view('guru.dashboard');
});
Route::get('/2', function () {
    return view('guru.laporan');
});
Route::prefix('ortu')->group(function () {
    Route::get('/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/rekap', [OrtuController::class, 'rekap'])->name('ortu.rekap');
    Route::get('/pengumuman', [OrtuController::class, 'pengumuman'])->name('ortu.pengumuman');
});

Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/rekap', [SiswaController::class, 'rekap'])->name('siswa.rekap');
    Route::get('/pengumuman', [SiswaController::class, 'pengumuman'])->name('siswa.pengumuman');
});
Route::get('/user-select', function () {
    return view('layout.user_select');
});

Route::get('/login', function () {
    return view('layout.login');
});



Route::get('/dashboard-guru', function () {
    return view('guru.datasiswa');
});

Route::post('/check-login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

