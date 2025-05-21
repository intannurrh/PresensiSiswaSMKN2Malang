<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use Carbon\Carbon;
use App\Models\Pengumuman;

class SiswaController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = session('get_data');

        if (!$data) {
            return redirect('/login')->with('error', 'Session tidak ditemukan, silakan login lagi.');
        }

        $siswa = DB::table('siswa')->where('id_user', $data->id_user)->first();

        if (!$siswa) {
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $presensis = DB::table('presensis')
            ->select('tanggal', 'status', 'created_at', 'jam_pulang') // pastikan 'created_at' diambil
            ->where('siswa_id', $siswa->id_siswa)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        $pengumuman = DB::table('pengumuman')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();

        return view('siswa.dashboard', compact('presensis', 'pengumuman', 'siswa'));
    }

    public function rekap()
    {
        $user = Auth::user();

        $rekap = DB::table('presensis')
            ->where('siswa_id', $user->id_siswa)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.rekap', compact('rekap'));
    }

    public function pengumuman()
    {
        $pengumuman = DB::table('pengumuman')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.pengumuman', compact('pengumuman'));
    }

    public function profile()
    {
        $user = session('get_data');

        $siswa = Siswa::with(['guru', 'orangTua'])
            ->where('id_user', $user->id_user)
            ->first();

        return view('siswa.profile', compact('siswa'));
    }

    public function formAbsen()
    {
        $data = session('get_data');
        if (!$data) {
            return redirect('/login')->with('error', 'Session tidak ditemukan.');
        }

        $siswa = Siswa::where('id_user', $data->id_user)->first();
        $tanggal = Carbon::today()->toDateString();

        $presensi = Presensi::where('siswa_id', $siswa->id_siswa)
            ->where('tanggal', $tanggal)
            ->first();

        $jamSekarang = Carbon::now('Asia/Jakarta')->format('H:i');
        $disableHadir = $jamSekarang >= '07:00';
        $enablePulang = $jamSekarang >= '14:30' && $jamSekarang <= '23:59';

        return view('siswa.presensi', [
            'sudahAbsen' => $presensi !== null,
            'disableHadir' => $disableHadir,
            'enablePulang' => $enablePulang,
            'presensi' => $presensi // dikirim agar bisa cek jam_pulang
        ]);
    }

    public function presensiPulang()
    {
        $data = session('get_data');
        $tanggal = Carbon::today()->toDateString();
        $jam = Carbon::now()->format('H:i:s');

        $siswa = Siswa::where('id_user', $data->id_user)->first();
        $presensi = Presensi::where('siswa_id', $siswa->id_siswa)
            ->where('tanggal', $tanggal)
            ->first();

        if (!$presensi) {
            return redirect()->back()->with('error', 'Kamu belum melakukan presensi pagi.');
        }

        if ($presensi->jam_pulang !== null) {
            return redirect()->back()->with('error', 'Kamu sudah melakukan presensi pulang.');
        }

        $presensi->update([
            'jam_pulang' => $jam
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Presensi pulang berhasil dicatat.');
    }

    public function presensi(Request $request)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
        ]);


        $tanggal = Carbon::today()->toDateString();

        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        $jamSekarang = Carbon::now()->format('H:i:s');
        $jamSekarangs = ('06.05');

        $data = session('get_data');

        $siswa = Siswa::where('id_user', $data->id_user)->first();
        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        $sudahAbsen = Presensi::where('siswa_id', $siswa->id_siswa)
            ->where('tanggal', $tanggal)
            ->exists();

        if ($sudahAbsen) {
            return redirect()->route('siswa.dashboard')->with('error', 'Kamu sudah mengisi presensi hari ini.');
        }

        $status = $jamSekarang < '07:00' ? 'Hadir' : 'Terlambat';


        Presensi::create([
            'siswa_id' => $siswa->id_siswa,
            'status' => $status,
            'tanggal' => $tanggal,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Presensi berhasil dikirim.');
    }
}
