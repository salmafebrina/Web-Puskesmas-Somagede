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
    Schema::create('transaksis', function (Blueprint $table) {

        $table->id('id_transaksi');

        $table->unsignedBigInteger('id_pasien');

        $table->unsignedBigInteger('id_pelayanan');

        $table->unsignedBigInteger('id_petugas');

        $table->string('no_seri_invoice')->unique();

        $table->date('tanggal_transaksi');

        $table->string('jenis_pembiayaan');

        $table->decimal('total_bayar', 12, 2)->default(0);

        $table->enum('status_pembayaran', [
            'Belum Bayar',
            'Lunas'
        ])->default('Belum Bayar');

        $table->timestamps();

        $table->foreign('id_pasien')
              ->references('id_pasien')
              ->on('pasiens')
              ->onDelete('cascade');

        $table->foreign('id_pelayanan')
              ->references('id_pelayanan')
              ->on('pelayanans')
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
        Schema::dropIfExists('transaksis');
    }
};
