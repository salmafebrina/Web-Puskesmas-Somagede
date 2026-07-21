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
    Schema::create('riwayat_medis', function (Blueprint $table) {

        $table->id('id_rekam_medis');

        $table->unsignedBigInteger('id_pasien');

        $table->unsignedBigInteger('id_petugas');

        $table->date('tanggal_pelayanan');

        $table->integer('umur_pasien');

        $table->decimal('bb_pasien', 5, 2)->nullable();

        $table->decimal('tb_pasien', 5, 2)->nullable();

        $table->decimal('lp_pasien', 5, 2)->nullable();

        $table->text('keterangan_alergi')->nullable();

        $table->text('objektif')->nullable();

        $table->text('assessment')->nullable();

        $table->text('diagnosa')->nullable();

        $table->string('kode_icd10')->nullable();

        $table->text('hasil_lab')->nullable();

        $table->timestamps();

        $table->foreign('id_pasien')
              ->references('id_pasien')
              ->on('pasiens')
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
        Schema::dropIfExists('riwayat_medis');
    }
};
