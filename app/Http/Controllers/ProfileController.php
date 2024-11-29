<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email:dns|unique:users,email,' . $user->id,
            'no_hp' => 'required|unique:users,no_hp,' . $user->id,
            'user_image' => 'image|max:2048|nullable'
        ]);

        $user->fill($validatedData);

        if ($request->hasFile('user_ktp')) {
            $path = Storage::disk('public')->put('ktp', $request->file('user_ktp'));
            $user->user_ktp = $path;
        }

        $user->save();

        return redirect('/profile')->with('sukses', 'Data Berhasil Diubah');
    }


    public function Change()
    {
        return view('dashboard.profile.ChangePassword');
    }

    public function ChangePassword(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $validasiData = $request->validate([
            'password' => 'Required|string|min:7|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
        ]);

        $validasiData['password'] = Hash::make($validasiData['password']);
        $user->update($validasiData);
        Auth::logout();
        session()->flush();
        return redirect('/')->with('sukses', 'Anda Telah Mengganti Password. Silakan Login Kembali');
    }
}
