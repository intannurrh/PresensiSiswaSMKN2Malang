<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View; // Import View


class UserController extends Controller
{
    // ... (method showUserSelectForm, showLoginForm jika ada) ...

    /**
     * Menangani percobaan autentikasi masuk.
     * (Method ini sama seperti sebelumnya, sudah menangani redirect ke dashboard yang sesuai)
     */
    public function login(Request $request)
    {
        $role = $request->role;
        $get_data = UserModel::where('nomor_pengenal', $request->nomor_pengenal)
            ->where('password', $request->password)
            ->where('role', $role)
            ->first();

        if ($get_data) {
            session(['get_data' => $get_data]);
            if ($role === 'guru') {
                return redirect('/dashboard-guru');
            } elseif ($role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            } elseif ($role === 'orangtua') {
                return redirect()->route('ortu.dashboard');
            } else {
                return redirect()->back()->with('error', 'Role tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Login gagal! Nomor pengenal atau password salah.');
        }
    }

    public function showGuruDashboard(): View|RedirectResponse // Bisa return View atau RedirectResponse
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Arahkan ke login jika belum login
        }

        // Periksa role user yang sedang login
        $user = Auth::UserModel();
        if ($user->role !== 'guru') {
            // Jika bukan guru, logout atau arahkan ke halaman lain
            Auth::logout(); // Contoh: logout saja
            return redirect()->route('user.select')->withErrors(['msg' => 'Akses ditolak. Anda bukan guru.']);
            // Atau bisa juga: return abort(403, 'Unauthorized action.');
        }

        // Jika user adalah guru, tampilkan view dashboard
        return view('guru.dashboard'); // Pastikan view ini ada
    }


    public function logout(Request $request)
    {
        // Hapus session yang disimpan saat login
        $request->session()->forget('get_data');

        // Regenerate session ID untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/user-select')->with('success', 'Anda berhasil logout.');
    }

    public function showSiswaDashboard(string $nama): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->role !== 'siswa' || $user->name !== $nama) {
            Auth::logout();
            return redirect()->route('user.select')->withErrors(['msg' => 'Akses ditolak.']);
        }

        return view('siswa.dashboard', compact('nama'));
    }
    public function showOrtuDashboard(string $nama): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->role !== 'ortu' || $user->name !== $nama) {
            Auth::logout();
            return redirect()->route('user.select')->withErrors(['msg' => 'Akses ditolak.']);
        }

        return view('ortu.dashboard', compact('nama'));
    }
}
