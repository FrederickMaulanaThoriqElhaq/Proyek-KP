<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bukti()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
