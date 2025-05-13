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
        // $credentials = $request->validate([
        //     'username' => ['required', 'string'],
        //     'password' => ['required'],
        //     'role' => ['required', 'string', 'in:guru,siswa,orangtua'],
        // ]);

        // $user = Auth::UserModel();
        // return $user;

        // dd($request->all());
        $get_data = UserModel::where('username', $request->username)->first();
        if ($get_data) {
            return $get_data;
        } 

        // if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        //     $user = Auth::UserModel();
        //     if ($user->role !== $credentials['role']) {
        //         Auth::logout();
        //         throw ValidationException::withMessages([
        //             'username' => 'Anda mencoba login sebagai peran (' . $credentials['role'] . ') yang berbeda dari akun Anda (' . $user->role . ').',
        //         ])->redirectTo(route('login', ['role' => $credentials['role']]));
        //     }

        //     $request->session()->regenerate();

        //     switch ($user->role) {
        //         case 'guru':
        //             return redirect()->intended(route('guru.dashboard')); // Gunakan nama rute
        //         case 'siswa':
        //             // return redirect()->intended(route('siswa.dashboard')); // Jika ada
        //             return redirect('/user-select')->with('status', 'Login berhasil, tetapi dashboard siswa belum tersedia.');
        //         case 'orangtua':
        //             // return redirect()->intended(route('orangtua.dashboard')); // Jika ada
        //             return redirect('/user-select')->with('status', 'Login berhasil, tetapi dashboard orang tua belum tersedia.');
        //         default:
        //             Auth::logout();
        //             return redirect('/user-select')->withErrors(['msg' => 'Role pengguna tidak valid setelah login.']);
        //     }
        // }

        // throw ValidationException::withMessages([
        //     'username' => __('auth.failed'),
        // ])->redirectTo(route('login', ['role' => $credentials['role']]));
    }

    /**
     * Menampilkan dashboard guru.
     * Pengecekan role dilakukan di sini.
     */
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


    /**
     * Menangani proses logout.
     */
     public function logout(Request $request): RedirectResponse
     {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.select');
     }

     // ... (method lain jika perlu) ...
}