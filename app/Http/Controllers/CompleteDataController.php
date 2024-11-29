<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompleteDataController extends Controller
{
    public function index()
    {
        return view('dashboard.lengkapi_data.index');
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $validasiData = $request->validate([
            'username' => 'required|min:3|max:255|unique:users,username,' . $user->id,
            'nik' => 'required|unique:users,nik,' . $user->id,
            'no_hp' => 'required|unique:users,no_hp,' . $user->id,
            'user_ktp' => 'image|file|max:2048|required'
        ]);

        if ($request->file('user_ktp')) {
            $validasiData['user_ktp'] = $request->file('user_ktp')->store('Verif_Ktp');
        }

        $user->update($validasiData);
        return redirect('dashboard')->with('sukses', 'Anda Berhasil Mengupload Data Silakan Tunggu Verifikasi Admin');
    }
}
