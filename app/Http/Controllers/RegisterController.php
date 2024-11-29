<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function reg()
    {
        return view('register.index');
    }

    public function register(Request $request)
    {
        $validasi = $request->validate([
            'name' => "required|max:255",
            'alamat' => 'required',
            'nik' => 'required|unique:users',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'no_hp' => 'required|unique:users',
            'password' => 'required|min:6|max:255|confirmed',
            'user_ktp' => 'image|file|max:2048'
        ]);
        $validasi['password'] = Hash::make($validasi['password']);

        if ($request->file('user_ktp')) {
            $validasi['user_ktp'] = Storage::disk('public')->put('Verif_Ktp', $request->file('user_ktp'));
        }

        User::create($validasi);
        return redirect('/')->with('sukses', 'Silakan Tunggu Persetujuan Admin 1 x 24 Jam');
    }
}
