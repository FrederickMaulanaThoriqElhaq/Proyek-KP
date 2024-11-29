<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AllUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ApproveUserController;
use App\Http\Controllers\CompleteDataController;
use App\Http\Controllers\ReVerifyUserController;
use App\Http\Controllers\PengaduanAdminController;
use App\Http\Controllers\SocialiteAccountController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate']);
});

//Socialite
Route::get('/auth/{provider}', [SocialiteAccountController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteAccountController::class, 'handleProviderCallback']);

//logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

//register
Route::middleware('guest')->group(function () {
    Route::get('/daftar', [RegisterController::class, 'reg'])->name('daftar');
    Route::post('/daftar', [RegisterController::class, 'register'])->name('pendaftaran');
});

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit_profile', [ProfileController::class, 'edit'])->name('edit.profile');
    Route::put('/edit_profile', [ProfileController::class, 'update'])->name('update.profile');
    Route::get('ChangePassword', [ProfileController::class, 'Change'])->name('Ubah.Password');
    Route::put('ChangePassword', [ProfileController::class, 'ChangePassword'])->name('UbahPassword.User');
});

//daftar semua anggota
Route::resource('/anggota', AllUserController::class)->middleware('admin');

//Approval User
Route::middleware(['admin'])->group(function () {
    Route::get('/approval', [ApproveUserController::class, 'index']);
    Route::put('/approval/{user}/approve', [ApproveUserController::class, 'approve'])->name('users.approval');
    Route::put('/approval/{user}/reverif', [ApproveUserController::class, 'ReVerif'])->name('users.reverif');
});

//Verifikasi Ulang User
Route::middleware(['admin'])->group(function () {
    Route::get('/verifikasi-ulang', [ReVerifyUserController::class, 'index']);
    Route::put('/verifikasi-ulang/{user}/approve', [ReVerifyUserController::class, 'update'])->name('verif.approval');
    Route::put('/verifikasi-ulang/{user}/rejected', [ReVerifyUserController::class, 'rejected'])->name('verif.rejected');
});

//Pengaduan User
Route::resource('/daftar-pengaduan-user', PengaduanController::class)->middleware('auth');

//Daftar Semua Pengaduan Admin
Route::middleware(['admin'])->group(function () {
    Route::get('daftar-pengaduan', [PengaduanAdminController::class, 'index']);
    Route::get('pengaduan-masuk', [PengaduanAdminController::class, 'masuk']);
    Route::get('pengaduan-diproses', [PengaduanAdminController::class, 'prosess']);
    Route::get('pengaduan-selesai', [PengaduanAdminController::class, 'selesaii']);
    Route::get('pengaduan-ditolak', [PengaduanAdminController::class, 'tolakk']);
    Route::get('show-pengaduan/{id}', [PengaduanAdminController::class, 'show'])->name('pengaduan.show');
    Route::put('show-pengaduan/{pengaduan}/proses', [PengaduanAdminController::class, 'proses'])->name('pengaduan.proses');
    Route::put('show-pengaduan/{pengaduan}/selesai', [PengaduanAdminController::class, 'selesai'])->name('pengaduan.selesai');
    Route::put('show-pengaduan/{pengaduan}/tolak', [PengaduanAdminController::class, 'tolak'])->name('pengaduan.tolak');
});

//Melengkapi Data User
Route::middleware('auth')->group(function () {
    Route::get('verifikasi-data', [CompleteDataController::class, 'index'])->name('lengkapi.data');
    Route::put('verifikasi-data/{id}', [CompleteDataController::class, 'updateProfile'])->name('update.data');
});
