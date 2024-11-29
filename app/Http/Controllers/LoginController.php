<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $login = $request->validate(
            [
                'email' => "required|email:dns",
                'password' => "required"
            ]
        );

        if (Auth::attempt($login)) {
            $user = User::findOrFail(Auth::user()->id);
            if ($user->status === 'pending') {
                Auth::logout();
                return redirect('/')->with('error', 'Akun Anda Belum Di Setujui Admin, Silakan Menunggu 1 x 24 Jam');
            }
            if ($user->status === 'rejected') {
                Auth::logout();
                return redirect('/')->with('tolak', 'Akun Anda Di Tolak Oleh Admin, Silakan Hubungi Admin Untuk Info Lebih Lanjut');
            }
            $request->session()->regenerate();

            $user->last_login = Carbon::now();
            $user->save();

            return redirect()->intended('/dashboard')->with('sukses', 'Berhasil masuk. Selamat Datang Di Aplikasi Pengaduan!👋');
        }
        return back()->with('gagal', 'Silakan Periksa Kembali Email/Password Anda');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logout', 'Anda Berhasil Keluar');
    }
}
