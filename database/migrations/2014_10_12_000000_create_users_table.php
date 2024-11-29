<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alamat')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->string('nik')->nullable();
            $table->string('user_image')->nullable();
            $table->string('user_ktp')->nullable();
            $table->string('password')->nullable();
            $table->enum('status', ['pending', 'approve', 'rejected', 'verif-ulang'])->default('pending');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
