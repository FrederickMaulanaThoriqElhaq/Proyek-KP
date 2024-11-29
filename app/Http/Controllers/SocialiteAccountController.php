<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\SocialiteAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SocialiteAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            Log::error('Gagal mendapatkan user dari provider: ' . $e->getMessage());
            return redirect('/')->with('error', 'Gagal melakukan autentikasi dengan provider.');
        }

        Log::info('User dari provider:', ['id' => $socialUser->getId(), 'email' => $socialUser->getEmail()]);

        $auth_user = $this->findOrCreateUser($socialUser, $provider);

        Log::info('Hasil findOrCreateUser:', ['auth_user' => $auth_user]);

        if (!$auth_user) {
            Log::error('Gagal membuat atau menemukan user');
            return redirect('/')->with('error', 'Gagal membuat atau menemukan akun pengguna.');
        }

        $auth_user->last_login = Carbon::now();
        $auth_user->save();

        $status = $auth_user->status;
        $messages = [
            'approve' => 'Berhasil masuk. Selamat Datang Di Aplikasi Pengaduan!👋',
            'pending' => 'Akun Anda sedang menunggu persetujuan dari admin. Silakan tunggu hingga 1 x 24 jam.',
            'rejected' => 'Akun Anda Ditolak Oleh Admin. Silakan Hubungi Admin Untuk Info Lebih Lanjut.',
            'verif-ulang' => 'Berhasil Masuk. Lengkapi Data Diri Anda.',
        ];

        if ($status === 'approve') {
            Auth::login($auth_user, true);
            return redirect('dashboard')
                ->with('sukses', $messages[$status]);
        } elseif ($status === 'verif-ulang') {
            Auth::login($auth_user, true);
            return redirect('dashboard')
                ->with('sukses', $messages[$status]);
        } elseif ($status === 'pending') {
            return redirect('/')
                ->with('error', $messages[$status]);
        } elseif ($status === 'rejected') {
            return redirect('/')
                ->with('tolak', $messages[$status]);
        } else {
            return redirect('/')
                ->with('error', 'Akun Anda sedang menunggu persetujuan dari admin. Silakan tunggu hingga 1 x 24 jam.');
        }
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        Log::info('Mencoba findOrCreateUser', [
            'provider' => $provider,
            'id' => $socialUser->getId(),
            'email' => $socialUser->getEmail(),
            'name' => $socialUser->getName()
        ]);

        $social_account = SocialiteAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        if ($social_account && $social_account->user) {
            Log::info('Social account dan user ditemukan', ['user_id' => $social_account->user_id]);
            return $social_account->user;
        } else {
            Log::info('Social account tidak ditemukan atau user tidak ada, mencari user berdasarkan email');
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                Log::info('User tidak ditemukan, mencoba membuat user baru');
                try {
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'status' => 'pending', // atau status default lainnya
                    ]);
                    Log::info('User baru berhasil dibuat', ['user_id' => $user->id]);
                } catch (\Exception $e) {
                    Log::error('Gagal membuat user baru', ['error' => $e->getMessage()]);
                    return null;
                }
            }

            if (!$social_account) {
                try {
                    $social_account = $user->social_accounts()->create([
                        'provider_id' => $socialUser->getId(),
                        'provider_name' => $provider
                    ]);
                    Log::info('Social account baru berhasil dibuat', ['user_id' => $user->id]);
                } catch (\Exception $e) {
                    Log::error('Gagal membuat social account baru', ['error' => $e->getMessage()]);
                    return null;
                }
            } else {
                $social_account->user()->associate($user);
                $social_account->save();
                Log::info('Social account yang ada diperbarui dengan user', ['user_id' => $user->id]);
            }

            return $user;
        }
    }
}
