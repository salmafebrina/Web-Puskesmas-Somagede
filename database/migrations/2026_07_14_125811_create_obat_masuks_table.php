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
        Schema::create('obat_masuks', function (Blueprint $table) {

            $table->id('id_obat_masuk');

            $table->unsignedBigInteger('id_obat');

            $table->date('tanggal_masuk');

            $table->integer('jumlah_masuk');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->foreign('id_obat')
                  ->references('id_obat')
                  ->on('obats')
                  ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat_masuks');
    }
};