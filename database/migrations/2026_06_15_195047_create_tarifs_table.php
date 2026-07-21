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
        Schema::create('tarifs', function (Blueprint $table) {

            $table->id('id_tarif');

            // Kode tarif
            $table->string('kode_tarif')->unique();

            // Nama tarif
            $table->string('nama_tarif');

            // Kategori tarif
            $table->enum('kategori_tarif', [
                'Pemeriksaan',
                'Tindakan',
                'Surat'
            ]);

            // Biaya
            $table->decimal('biaya_tarif', 12, 2);

            // Status tarif
            $table->enum('status_tarif', [
                'Aktif',
                'Nonaktif'
            ])->default('Aktif');

            $table->timestamps();
        });
    }
};