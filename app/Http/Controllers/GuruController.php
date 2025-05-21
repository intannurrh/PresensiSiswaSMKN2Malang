<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;



class GuruController extends Controller
{
    public function downloadLaporanExcel(Request $request)
    {
        // Pastikan pengguna sudah login
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil data guru berdasarkan id_user
        $guru = Guru::where('id_user', $get_data->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        // Ambil parameter tanggal (opsional)
        $tanggal = $request->input('tanggal');

        // Unduh file Excel
        return Excel::download(new PresensiExport($guru->id_guru, $tanggal), 'rekapan_kehadiran.xlsx');
    }
    public function dashboard()
    {
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru = Guru::where('id_user', $get_data->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $today = \Carbon\Carbon::now('Asia/Jakarta')->toDateString();

        // 1. Ambil semua siswa milik guru
        $siswaList = Siswa::where('id_guru', $guru->id_guru)->get();

        // 2. Ambil semua presensi hari ini
        $presensisToday = Presensi::whereDate('tanggal', $today)->get()->keyBy('siswa_id');

        // 3. Tambahkan properti 'presensi_today' ke masing-masing siswa
        foreach ($siswaList as $siswa) {
            $siswa->presensi_today = $presensisToday->get($siswa->id_siswa);
        }

        return view('guru.dashboard', compact('siswaList'));
    }




    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('guru.dashboard')->with('success', 'Data berhasil dihapus');
    }


    public function laporan(Request $request)
    {
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru = Guru::where('id_user', $get_data->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        // Ambil parameter tanggal (opsional)
        $tanggal = $request->input('tanggal');

        // Query presensi berdasarkan guru dan opsional tanggal
        $query = Presensi::with('siswa')
            ->whereHas('siswa', function ($q) use ($guru) {
                $q->where('id_guru', $guru->id_guru);
            });

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $presensis = $query->orderBy('tanggal', 'desc')->get();

        return view('guru.laporan', compact('presensis', 'tanggal'));
    }

    public function dataAnakKelasSaya()
    {
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru = Guru::where('id_user', $get_data->id_user)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $siswa = Siswa::with('orangTua')
            ->where('id_guru', $guru->id_guru)
            ->get();

        return view('guru.datasiswa', compact('siswa'));
    }

    public function profile()
    {
        $user = session('get_data'); // ambil data user login dari session

        // Cari data guru berdasarkan id_user
        $guru = Guru::where('id_user', $user->id_user)->first();

        return view('guru.profile', compact('guru'));
    }
    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'nullable|date_format:H:i',
        ]);

        // Gabungkan tanggal dan jam untuk created_at
        if ($request->filled('jam')) {
            $combinedDatetime = Carbon::parse($request->tanggal . ' ' . $request->jam);
            $presensi->created_at = $combinedDatetime;
        } else {
            $presensi->created_at = Carbon::parse($request->tanggal . ' 00:00:00');
        }

        $presensi->status = $request->status;
        $presensi->tanggal = $request->tanggal;
        $presensi->save();

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }
}
