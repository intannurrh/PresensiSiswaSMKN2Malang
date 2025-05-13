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

    // public function rekap() {
    //     return view('ortu.rekap'); // nanti bikin ortu/rekap.blade.php
    // }


    // public function rekap()
    // {
    //     // Data dummy untuk testing, ganti nanti dengan data dari database
    //     $ortu = [
    //         ['tanggal' => '2025-05-01', 'status' => 'Hadir'],
    //         ['tanggal' => '2025-05-02', 'status' => 'Izin'],
    //         ['tanggal' => '2025-05-03', 'status' => 'Alpha'],
    //     ];

    //     return view('ortu.rekap', compact('ortu'));
    // }

    public function pengumuman()
    {
        $pengumuman = DB::table('pengumuman')->orderBy('tanggal', 'desc')->get();
        return view('ortu.pengumuman', compact('pengumuman'));
    }
    // public function rekapKehadiran()
    // {
    //     $data = [
    //         ['date' => '2025-04-01', 'status' => 'Hadir'],
    //         ['date' => '2025-04-02', 'status' => 'Tidak Hadir'],
    //         ['date' => '2025-04-03', 'status' => 'Hadir'],
    //         ['date' => '2025-04-04', 'status' => 'Sakit'],
    //         ['date' => '2025-04-05', 'status' => 'Izin']
    //     ];

    //     return view('ortu.rekap', ['rekapKehadiran' => $data]);
    // }
    public function rekap()
    {
        $rekap_kehadiran = rekap_kehadiran::where('siswa_id', auth()->user()->siswa_id)->get();

        return view('ortu.rekap', compact('rekap_kehadiran'));
    }




}
