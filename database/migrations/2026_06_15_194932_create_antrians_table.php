<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('antrians', function (Blueprint $table) {

        $table->id('id_antrian');

        $table->unsignedBigInteger('id_pasien');

        $table->string('kode_antrian');

        $table->string('jenis_antrian');

        $table->date('tanggal_antrian');

        $table->enum('status_antrian', [
            'Menunggu',
            'Dipanggil',
            'Selesai'
        ])->default('Menunggu');

        $table->timestamps();

        $table->foreign('id_pasien')
              ->references('id_pasien')
              ->on('pasiens')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
