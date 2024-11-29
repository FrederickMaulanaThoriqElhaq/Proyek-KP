<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.pengaduan.admin.index', [
            'pengaduan' => Pengaduan::all()
        ]);
    }
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('dashboard.pengaduan.admin.show', [
            'pengaduan' => $pengaduan
        ]);
    }

    public function proses(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'proses']);
        return redirect('pengaduan-diproses')->with('sukses', 'Silakan Proses Pengaduan');
    }

    public function selesai(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'selesai']);
        return redirect('pengaduan-selesai')->with('sukses', 'Pengaduan Selesai');
    }

    public function tolak(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'tolak']);
        return redirect('pengaduan-ditolak')->with('sukses', 'Pengaduan Di Tolak');
    }

    public function masuk()
    {
        return view('dashboard.pengaduan.admin.masuk', [
            'pengaduan' => Pengaduan::all()
        ]);
    }
    public function prosess()
    {
        return view('dashboard.pengaduan.admin.proses', [
            'pengaduan' => Pengaduan::all()
        ]);
    }
    public function selesaii()
    {
        return view('dashboard.pengaduan.admin.selesai', [
            'pengaduan' => Pengaduan::all()
        ]);
    }
    public function tolakk()
    {
        return view('dashboard.pengaduan.admin.tolak', [
            'pengaduan' => Pengaduan::all()
        ]);
    }
}
