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
    Schema::create('petugas', function (Blueprint $table) {

        $table->id('id_petugas');

        $table->string('nama_petugas');

        $table->string('nip_petugas')->unique();

        $table->string('jabatan');

        $table->string('tugas_pelayanan');

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
