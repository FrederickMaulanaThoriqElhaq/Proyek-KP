<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AllUserController extends Controller
{
    public function index()
    {
        return view('dashboard.User.AllUser', [
            'user' => User::all()
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.User.ShowUser', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.User.EditUser', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validasiData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email:dns|unique:users,email,' . $user->id,
            'no_hp' => 'required|unique:users,no_hp,' . $user->id,
            'password' => 'nullable|string|min:7|confirmed',
            'user_image' => 'image|file|max:2048|nullable'
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
        ]);

        if (!is_null($validasiData['password'])) {
            $validasiData['password'] = Hash::make($validasiData['password']);
            $user->update($validasiData);
            return redirect('/anggota')->with('sukses', 'Anda Telah Mengganti Password User');
        } else {
            $user->update([
                'name' => $validasiData['name'],
                'username' => $validasiData['username'],
                'email' => $validasiData['email'],
                'no_hp' => $validasiData['no_hp'],
                'user_image' => $validasiData['user_image'] ?? $user->user_image
            ]);

            if ($request->hasFile('user_ktp')) {
                $path = Storage::disk('public')->put('ktp', $request->file('user_ktp'));
                $user->user_ktp = $path;
            }

            return redirect('/anggota')->with('sukses', 'Data Berhasil Di Ubah');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->user_ktp) {
            Storage::disk('public')->delete($user->user_ktp);
        }

        User::destroy($user->id);
        return redirect('/anggota')->with('sukses', 'Anda Berhasil Menghapus Data Anggota');
    }
}
