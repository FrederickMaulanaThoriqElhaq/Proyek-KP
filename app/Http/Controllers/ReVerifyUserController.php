<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReVerifyUserController extends Controller
{
    public function index()
    {
        return view('dashboard.User.ReVerifyUser', [
            'user' => User::all()
        ]);
    }

    public function update(User $user)
    {
        $user->update(['status' => 'approve']);
        return redirect('/anggota')->with('sukses', 'Anda Berhasil Memverifikasi Ulang User');
    }

    public function rejected(User $user)
    {
        $user->update(['status' => 'rejected']);
        return redirect('verifikasi-ulang')->with('sukses', 'Anda Berhasil Menolak User');
    }
}
