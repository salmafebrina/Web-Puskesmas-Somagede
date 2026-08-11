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
       Schema::create('rujukans', function (Blueprint $table) {

    $table->id('id_rujukan');

    $table->unsignedBigInteger('id_rekam_medis');

    $table->string('fasilitas_tujuan');

    $table->string('poli_tujuan');

    $table->string('dokter_tujuan')->nullable();

    $table->text('alasan_rujukan');

    $table->text('catatan')->nullable();

    $table->timestamps();

    $table->foreign('id_rekam_medis')
          ->references('id_rekam_medis')
          ->on('riwayat_medis')
          ->cascadeOnDelete();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rujukans');
    }
};
