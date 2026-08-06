<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Menyelaraskan skema tabel pasiens dengan Model Pasien dan seluruh
     * controller (PasienController, AntrianController) yang sudah menggunakan
     * kolom nik_pasien, id_rekam_medis, rt, rw, dan status_registrasi.
     * Migration asli masih memakai id_ktp dan belum punya kolom-kolom tersebut.
     *
     * Memakai raw SQL agar tidak bergantung pada doctrine/dbal.
     */
    public function up(): void
    {
        // id_ktp -> nik_pasien
        if (Schema::hasColumn('pasiens', 'id_ktp') && !Schema::hasColumn('pasiens', 'nik_pasien')) {
            DB::statement('ALTER TABLE `pasiens` CHANGE `id_ktp` `nik_pasien` VARCHAR(255) NOT NULL');
        }

        if (!Schema::hasColumn('pasiens', 'id_rekam_medis')) {
            DB::statement('ALTER TABLE `pasiens` ADD `id_rekam_medis` VARCHAR(255) NULL AFTER `id_pasien`');
        }
        if (!Schema::hasColumn('pasiens', 'rt')) {
            DB::statement('ALTER TABLE `pasiens` ADD `rt` VARCHAR(255) NULL AFTER `kode_desa`');
        }
        if (!Schema::hasColumn('pasiens', 'rw')) {
            DB::statement('ALTER TABLE `pasiens` ADD `rw` VARCHAR(255) NULL AFTER `rt`');
        }
        if (!Schema::hasColumn('pasiens', 'status_registrasi')) {
            DB::statement("ALTER TABLE `pasiens` ADD `status_registrasi` VARCHAR(255) NOT NULL DEFAULT 'lengkap' AFTER `no_hp`");
        }

        // Kolom wajib dibuat nullable agar pasien draft (baru NIK + tgl lahir) bisa dibuat
        DB::statement('ALTER TABLE `pasiens` MODIFY `no_hp` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `pasiens` MODIFY `nama_pasien` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `pasiens` MODIFY `nama_kk` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `pasiens` MODIFY `alamat_pasien` TEXT NULL');
        DB::statement('ALTER TABLE `pasiens` MODIFY `kode_desa` VARCHAR(255) NULL');
    }

    public function down(): void
    {
        if (Schema::hasColumn('pasiens', 'nik_pasien') && !Schema::hasColumn('pasiens', 'id_ktp')) {
            DB::statement('ALTER TABLE `pasiens` CHANGE `nik_pasien` `id_ktp` VARCHAR(255) NOT NULL');
        }
        foreach (['id_rekam_medis', 'rt', 'rw', 'status_registrasi'] as $col) {
            if (Schema::hasColumn('pasiens', $col)) {
                DB::statement("ALTER TABLE `pasiens` DROP COLUMN `{$col}`");
            }
        }
    }
};
