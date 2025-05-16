<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class GuruController extends Controller
{
    public function dashboard()
    {
        // Ambil data presensi hari ini dengan relasi siswa
        $presensis = Presensi::with('siswa')
            ->whereDate('tanggal', now()->toDateString())
            ->get();  // <-- titik koma ini wajib ada

        //  dd($presensis);

        return view('guru.dashboard', compact('presensis'));
    }

    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('guru.dashboard')->with('success', 'Data berhasil dihapus');
    }

    public function datasiswa()
    {
        return view('guru.datasiswa');
    }


    public function downloadCSV()
    {
        $data = Presensi::with('siswa')
            ->whereDate('tanggal', now()->toDateString())
            ->get();

        $filename = "laporan_kehadiran.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Nama', 'Status', 'Tanggal', 'Jam']);

        foreach ($data as $row) {
            fputcsv($handle, [
                $row->siswa->nama ?? 'Tidak diketahui',
                $row->status,
                $row->tanggal,
                $row->jam ?? '-'
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
    public function laporan()
    {
        $presensis = Presensi::with('siswa')->orderBy('tanggal', 'desc')->get();
        return view('guru.laporan', compact('presensis'));
    }
    public function dataAnakKelasSaya()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $guru = \App\Models\Guru::where('id_user', $user->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $siswa = \App\Models\Siswa::with('orangTua')
            ->where('kelas', $guru->kelas)
            ->where('jurusan', $guru->jurusan)
            ->get();

        return view('guru.datasiswa', compact('siswa'));
    }

}
