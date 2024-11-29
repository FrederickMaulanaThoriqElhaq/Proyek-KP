<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bukti()
    {
        return $this->hasMany(Bukti::class);
    }

    public static function countPengaduan()
    {
        return self::count();
    }

    public static function countPengaduanMasuk()
    {
        return self::where('status', 'masuk')->count();
    }
    public static function countPengaduanProses()
    {
        return self::where('status', 'Proses')->count();
    }
    public static function countPengaduanSelesai()
    {
        return self::where('status', 'Selesai')->count();
    }
    public static function countPengaduanTolak()
    {
        return self::where('status', 'tolak')->count();
    }
    public static function countPengaduanDiriSendiri($userId)
    {
        return self::where('id_user', $userId)->count();
    }
    public static function countPengaduanDiriSendiriDitolak($userId)
    {
        return self::where('id_user', $userId)
            ->where('status', 'tolak')
            ->count();
    }
    public static function countPengaduanDiriSendiriDiProses($userId)
    {
        return self::where('id_user', $userId)
            ->where('status', 'proses')
            ->count();
    }
    public static function countPengaduanDiriSendiriSelesai($userId)
    {
        return self::where('id_user', $userId)
            ->where('status', 'selesai')
            ->count();
    }
}
