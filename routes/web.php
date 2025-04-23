<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-guru', function () {
    return view('guru.dashboard');
});
