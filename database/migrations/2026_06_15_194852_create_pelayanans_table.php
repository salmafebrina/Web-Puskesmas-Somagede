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
    Schema::create('pelayanans', function (Blueprint $table) {

        $table->id('id_pelayanan');

        $table->unsignedBigInteger('id_rekam_medis');

        $table->unsignedBigInteger('id_petugas');

        $table->string('unit_pelayanan');

        $table->string('jenis_tindakan')->nullable();

        $table->string('jenis_pemeriksaan')->nullable();

        $table->string('jenis_pemeriksaan_lab')->nullable();

        $table->date('tanggal_pelayanan');

        $table->timestamps();

        $table->foreign('id_rekam_medis')
              ->references('id_rekam_medis')
              ->on('riwayat_medis')
              ->onDelete('cascade');

        $table->foreign('id_petugas')
              ->references('id_petugas')
              ->on('petugas')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanans');
    }
};
