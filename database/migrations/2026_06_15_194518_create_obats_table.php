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
   Schema::create('obats', function (Blueprint $table) {
    $table->id('id_obat');
    $table->string('nama_obat');
    $table->string('jenis_obat');
    $table->string('kategori_obat');
    $table->integer('stok_obat');
    $table->string('satuan_obat');
    $table->integer('stok_minimum');
    $table->date('tanggal_expired');

    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
