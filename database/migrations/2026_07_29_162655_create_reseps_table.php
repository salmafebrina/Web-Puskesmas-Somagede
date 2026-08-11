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
       Schema::create('reseps', function (Blueprint $table) {
    $table->id('id_resep');

    $table->unsignedBigInteger('id_riwayat_medis');

    $table->string('kode_resep')->unique();

    $table->enum('status', [
        'Menunggu Penyiapan',
        'Selesai'
    ])->default('Menunggu Penyiapan');

    $table->timestamps();

    $table->foreign('id_riwayat_medis')
        ->references('id_riwayat_medis')
        ->on('riwayat_medis')
        ->cascadeOnDelete();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
