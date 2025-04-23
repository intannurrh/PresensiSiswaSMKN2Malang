<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dummy - nanti bisa diganti pakai model dari database
        $presensi = [
            (object)[ 'nama' => 'Ahmad Rizki', 'status' => 'Hadir', 'tanggal' => '2025-04-22' ],
            (object)[ 'nama' => 'Dewi Lestari', 'status' => 'Tidak Hadir', 'tanggal' => '2025-04-22' ],
            (object)[ 'nama' => 'Bayu Pratama', 'status' => 'Terlambat', 'tanggal' => '2025-04-22' ],
        ];

        // Hitung status
        $hadir = collect($presensi)->where('status', 'Hadir')->count();
        $tidakHadir = collect($presensi)->where('status', 'Tidak Hadir')->count();
        $terlambat = collect($presensi)->where('status', 'Terlambat')->count();

        return view('dashboard', compact('presensi', 'hadir', 'tidakHadir', 'terlambat'));
    }

    public function dataSiswa()
    {
        // Sementara kosong, nanti bisa arahkan ke view data siswa
        return view('data-siswa');
    }

    public function laporan()
    {
        // Halaman laporan kehadiran
        return view('laporan');
    }
}
