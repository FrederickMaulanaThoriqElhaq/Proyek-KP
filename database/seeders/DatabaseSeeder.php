<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'SPKT',
            'username' => 'SPKT',
            'email' => 'spkt@polri.go.id',
            'no_hp' => '110',
            'is_admin' => 1,
            'status' => 'approve',
            'password' => bcrypt('1234567')
        ]);
    }
}
