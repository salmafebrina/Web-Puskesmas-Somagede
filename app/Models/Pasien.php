<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $primaryKey = 'id_pasien';

    protected $fillable = [
    'id_rekam_medis',
    'nik_pasien',
    'id_bpjs',
    'nama_pasien',
    'nama_kk',
    'jenis_kelamin',
    'tanggal_lahir',
    'alamat_pasien',
    'kode_desa',
    'rt',
    'rw',
    'no_hp',
    'status_registrasi',
];
}