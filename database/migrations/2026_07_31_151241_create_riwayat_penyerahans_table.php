<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('riwayat_penyerahan', function (Blueprint $table) {

        $table->id('id_penyerahan');

        $table->unsignedBigInteger('id_resep');

        $table->timestamp('tanggal_penyerahan');

        $table->unsignedBigInteger('id_user');

        $table->timestamps();

        $table->foreign('id_resep')
              ->references('id_resep')
              ->on('reseps')
              ->cascadeOnDelete();

        $table->foreign('id_user')
              ->references('id_user')
              ->on('users');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_penyerahans');
    }
};
