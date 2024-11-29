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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('barang_hilang');
            $table->date('tgl_hilang');
            $table->time('waktu_hilang');
            $table->string('lokasi_hilang');
            $table->text('kronologi');
            $table->enum('status', ['masuk', 'proses', 'selesai', 'tolak'])->default('masuk');
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
        Schema::dropIfExists('pengaduans');
    }
};
