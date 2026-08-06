<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            [
                'id_rekam_medis' => '00001',
                'nik_pasien'     => '3302010101900001',
                'id_bpjs'        => '0001234567890',
                'nama_pasien'    => 'Sutrisno',
                'nama_kk'        => 'Sutrisno',
                'jenis_kelamin'  => 'L',
                'tanggal_lahir'  => '1990-01-01',
                'alamat_pasien'  => 'Dusun Krajan RT 02 RW 01',
                'kode_desa'      => 'SOMAGEDE',
                'rt'             => '02',
                'rw'             => '01',
                'no_hp'          => '081234567801',
            ],
            [
                'id_rekam_medis' => '00002',
                'nik_pasien'     => '3302014502920002',
                'id_bpjs'        => '0001234567891',
                'nama_pasien'    => 'Siti Aminah',
                'nama_kk'        => 'Sutrisno',
                'jenis_kelamin'  => 'P',
                'tanggal_lahir'  => '1992-02-05',
                'alamat_pasien'  => 'Dusun Krajan RT 02 RW 01',
                'kode_desa'      => 'SOMAGEDE',
                'rt'             => '02',
                'rw'             => '01',
                'no_hp'          => '081234567802',
            ],
            [
                'id_rekam_medis' => '00003',
                'nik_pasien'     => '3302011203850003',
                'id_bpjs'        => null,
                'nama_pasien'    => 'Bambang Wijaya',
                'nama_kk'        => 'Bambang Wijaya',
                'jenis_kelamin'  => 'L',
                'tanggal_lahir'  => '1985-03-12',
                'alamat_pasien'  => 'Dusun Kalisari RT 04 RW 02',
                'kode_desa'      => 'KEMAWI',
                'rt'             => '04',
                'rw'             => '02',
                'no_hp'          => '081234567803',
            ],
            [
                'id_rekam_medis' => '00004',
                'nik_pasien'     => '3302016007780004',
                'id_bpjs'        => '0001234567893',
                'nama_pasien'    => 'Endang Lestari',
                'nama_kk'        => 'Wagimin',
                'jenis_kelamin'  => 'P',
                'tanggal_lahir'  => '1978-07-20',
                'alamat_pasien'  => 'Dusun Tugu RT 01 RW 03',
                'kode_desa'      => 'PLANA',
                'rt'             => '01',
                'rw'             => '03',
                'no_hp'          => '081234567804',
            ],
            [
                'id_rekam_medis' => '00005',
                'nik_pasien'     => '3302012508150005',
                'id_bpjs'        => null,
                'nama_pasien'    => 'Rizki Ramadhan',
                'nama_kk'        => 'Bambang Wijaya',
                'jenis_kelamin'  => 'L',
                'tanggal_lahir'  => '2015-08-25',
                'alamat_pasien'  => 'Dusun Kalisari RT 04 RW 02',
                'kode_desa'      => 'KEMAWI',
                'rt'             => '04',
                'rw'             => '02',
                'no_hp'          => '081234567803',
            ],
            [
                'id_rekam_medis' => '00006',
                'nik_pasien'     => '3302015010600006',
                'id_bpjs'        => '0001234567895',
                'nama_pasien'    => 'Painem',
                'nama_kk'        => 'Karto',
                'jenis_kelamin'  => 'P',
                'tanggal_lahir'  => '1960-10-10',
                'alamat_pasien'  => 'Dusun Somagede RT 03 RW 01',
                'kode_desa'      => 'SOMAGEDE',
                'rt'             => '03',
                'rw'             => '01',
                'no_hp'          => '081234567806',
            ],
        ];

        foreach ($pasiens as $data) {
            Pasien::updateOrCreate(
                ['nik_pasien' => $data['nik_pasien']],
                array_merge($data, ['status_registrasi' => 'lengkap'])
            );
        }
    }
}
