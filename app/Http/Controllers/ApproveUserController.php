<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApproveUserController extends Controller
{
    public function index()
    {
        return view('dashboard.User.ApprovalUser', [
            'user' => User::all()
        ]);
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'approve']);
        return redirect('/anggota')->with('sukses', 'Anda Telah Memverifikasi User');
    }

    public function ReVerif(User $user)
    {
        $user->update(['status' => 'verif-ulang']);
        return redirect('verifikasi-ulang')->with('sukses', 'Anda Telah Menolak Permintaan Verifikasi User');
    }
}
