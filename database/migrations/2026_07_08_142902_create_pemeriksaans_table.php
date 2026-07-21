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
    Schema::create('pemeriksaans', function (Blueprint $table) {

        $table->id('id_pemeriksaan');

        $table->unsignedBigInteger('id_kunjungan');

        // =========================
        // Pemeriksaan Awal (Perawat)
        // =========================

        $table->decimal('berat_badan',5,2);

        $table->decimal('tinggi_badan',5,2);

        $table->decimal('lingkar_perut',5,2)->nullable();

        $table->string('tekanan_darah');

        $table->decimal('suhu',4,1);

        $table->integer('nadi');

        $table->integer('respirasi');

        $table->text('keluhan');

        // =========================
        // Pemeriksaan Poli (Dokter)
        // =========================

        $table->text('objektif')->nullable();

        $table->text('assessment')->nullable();

        $table->string('kode_icd10')->nullable();

        $table->text('diagnosa')->nullable();

        $table->text('tindakan')->nullable();

        // =========================

        $table->string('status_pemeriksaan')
              ->default('Menunggu Pemeriksaan Poli');

        $table->timestamps();

        $table->foreign('id_kunjungan')
            ->references('id_kunjungan')
            ->on('kunjungans')
            ->cascadeOnDelete();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
