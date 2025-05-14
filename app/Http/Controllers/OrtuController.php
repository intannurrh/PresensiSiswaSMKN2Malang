<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\rekap_kehadiran;


class OrtuController extends Controller
{
    public function dashboard()
    {
        return view('ortu.dashboard');
    }
    public function pengumuman()
    {
        $pengumuman = DB::table('pengumuman')->orderBy('tanggal', 'desc')->get();
        return view('ortu.pengumuman', compact('pengumuman'));
    }
    public function rekap()
    {
        $rekap_kehadiran = rekap_kehadiran::where('siswa_id', auth()->user()->siswa_id)->get();

        return view('ortu.rekap', compact('rekap_kehadiran'));
    }




}
