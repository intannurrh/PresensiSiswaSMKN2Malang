<?php

use Illuminate\Support\Facades\Route;

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
