<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = ['id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
}


    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }

    public static function countAdmins()
    {
        return self::where('is_admin', 1)->count();
    }

    public static function countUser()
    {
        return self::where('is_admin', 0)
            ->where('status', 'approve')
            ->count();
    }
    public static function countUserApprove()
    {
        return self::where('status', 'pending')->count();
    }

    public function social_accounts()
    {
        return $this->hasMany(SocialiteAccount::class, 'id_user');
    }
}
