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
        Schema::create('transaksi_pembayarans', function (Blueprint $table) {

    $table->id('id_transaksi');

    $table->foreignId('id_kunjungan')
          ->constrained('kunjungans', 'id_kunjungan')
          ->cascadeOnDelete();

    $table->string('no_transaksi')->unique();

    $table->dateTime('tanggal_pembayaran');

    $table->string('metode_pembayaran');

    $table->decimal('total_pembayaran',12,2);

    $table->decimal('nominal_bayar',12,2);

    $table->decimal('kembalian',12,2);

    $table->enum('status_pembayaran',[
        'Lunas',
        'Belum Lunas'
    ]);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembayarans');
    }
};
