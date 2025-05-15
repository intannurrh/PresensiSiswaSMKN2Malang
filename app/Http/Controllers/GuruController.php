<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;

class GuruController extends Controller
{
    public function dashboard()
    {
        // Ambil data presensi hari ini dengan relasi siswa
        $presensis = Presensi::with('siswa')
            ->whereDate('tanggal', now()->toDateString())
            ->get();  // <-- titik koma ini wajib ada

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

    public function laporan()
    {
        return view('guru.laporan');
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
}
