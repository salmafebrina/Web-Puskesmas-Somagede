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
        Schema::create('laboratoriums', function (Blueprint $table) {

    $table->id('id_laboratorium');

    $table->unsignedBigInteger('id_rekam_medis');

    $table->string('jenis_pemeriksaan');

    $table->text('catatan')->nullable();

    $table->enum('status', [
        'Menunggu',
        'Diproses',
        'Selesai'
    ])->default('Menunggu');

    $table->text('hasil_pemeriksaan')->nullable();

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
        Schema::dropIfExists('laboratoriums');
    }
};
