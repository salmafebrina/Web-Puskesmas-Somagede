<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom-kolom ini sudah dipakai di KunjunganController, AntrianController,
     * dan PemeriksaanAwalController serta terdaftar di $fillable model Kunjungan,
     * namun belum ada di migration asli. Ditambahkan agar skema konsisten.
     */
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            if (!Schema::hasColumn('kunjungans', 'tanggal_kunjungan')) {
                $table->date('tanggal_kunjungan')->nullable()->after('status_pasien');
            }
            if (!Schema::hasColumn('kunjungans', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('nama_kk');
            }
            if (!Schema::hasColumn('kunjungans', 'deskripsi_alamat')) {
                $table->text('deskripsi_alamat')->nullable()->after('no_hp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kunjungan', 'no_hp', 'deskripsi_alamat']);
        });
    }
};
