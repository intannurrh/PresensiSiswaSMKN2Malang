<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use App\Models\Siswa;


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
    public function dataSiswa()
    {
        $guru = Auth::user(); // pastikan user yang login adalah guru
        $siswas = Siswa::where('id_guru', $guru->id)->get(); // ambil siswa sesuai id guru

        return view('guru.datasiswa', compact('siswas'));
    }
}
