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
    Schema::create('pasiens', function (Blueprint $table) {

        $table->id('id_pasien');

        $table->string('id_ktp')->unique();

        $table->string('id_bpjs')->nullable();

        $table->string('nama_pasien');

        $table->string('nama_kk');

        $table->enum('jenis_kelamin', ['L', 'P']);

        $table->date('tanggal_lahir');

        $table->text('alamat_pasien');

        $table->string('kode_desa');

        $table->string('no_hp');

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
