<?php

namespace App\Http\Controllers;


use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();
        return view('pengumuman.index', compact('pengumuman'));
    }
}
