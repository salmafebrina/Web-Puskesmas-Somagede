<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obat_keluars', function (Blueprint $table) {

            $table->id('id_obat_keluar');

            $table->unsignedBigInteger('id_obat');

            $table->unsignedBigInteger('id_kunjungan');

            $table->date('tanggal_keluar');

            $table->integer('jumlah_keluar');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->foreign('id_obat')
                ->references('id_obat')
                ->on('obats')
                ->cascadeOnDelete();

            $table->foreign('id_kunjungan')
                ->references('id_kunjungan')
                ->on('kunjungans')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obat_keluars');
    }
};