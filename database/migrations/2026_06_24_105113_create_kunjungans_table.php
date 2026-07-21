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
        Schema::create('kunjungans', function (Blueprint $table) {

    $table->id('id_kunjungan');

    $table->string('kode_kunjungan')->unique();

    $table->string('nik_pasien');

    $table->string('nama_pasien');

    $table->string('no_rekam_medis')->nullable();

    $table->integer('usia')->nullable();

    $table->string('jenis_kelamin')->nullable();

    $table->string('status_pasien');

    $table->string('jenis_jaminan');

    $table->string('no_bpjs')->nullable();

    $table->string('poli_tujuan');

    $table->string('desa')->nullable();

    $table->string('rt')->nullable();

    $table->string('rw')->nullable();

    $table->string('nama_kk')->nullable();

    $table->string('status_kunjungan');

    $table->string('surat_keterangan')->default('Tidak Ada');
    $table->string('keterangan_surat')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
