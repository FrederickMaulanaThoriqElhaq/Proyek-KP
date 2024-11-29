<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $totalAdmins = User::countAdmins();
        $totalUsers = User::countUser();
        $totalPengaduan = Pengaduan::countPengaduan();
        $countPengaduanMasuk = Pengaduan::countPengaduanMasuk();
        $countPengaduanProses = Pengaduan::countPengaduanProses();
        $countPengaduanSelesai = Pengaduan::countPengaduanSelesai();
        $countPengaduanTolak = Pengaduan::countPengaduanTolak();
        $totalApproveUsers = User::countUserApprove();
        $totalPengaduanSendiri = Pengaduan::countPengaduanDiriSendiri($userId);
        $totalPengaduanSendiriDitolak = Pengaduan::countPengaduanDiriSendiriDitolak($userId);
        $totalPengaduanSendiriDiproses = Pengaduan::countPengaduanDiriSendiriDiProses($userId);
        $totalPengaduanSendiriSelesai = Pengaduan::countPengaduanDiriSendiriSelesai($userId);

        return view('dashboard.index', compact(
            'totalAdmins',
            'totalUsers',
            'totalPengaduan',
            'countPengaduanMasuk',
            'countPengaduanProses',
            'countPengaduanSelesai',
            'countPengaduanTolak',
            'totalApproveUsers',
            'totalPengaduanSendiri',
            'totalPengaduanSendiriDitolak',
            'totalPengaduanSendiriDiproses',
            'totalPengaduanSendiriSelesai'
        ));
    }
}
