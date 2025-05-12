<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrtuController;


Route::get('/', function () {
    return view('guru.datasiswa');
});
Route::get('/1', function () {
    return view('guru.dashboard');
});
Route::get('/2', function () {
    return view('guru.laporan');
});
Route::get('/3', function () {
    return view('ortu.dashboard');
});
Route::prefix('ortu')->group(function () {
    Route::get('/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/rekap', [OrtuController::class, 'rekap'])->name('ortu.rekap');
    Route::get('/pengumuman', [OrtuController::class, 'pengumuman'])->name('ortu.pengumuman');
});
Route::get('/ortu/rekap', [OrtuController::class, 'rekap'])->name('ortu.rekap');
