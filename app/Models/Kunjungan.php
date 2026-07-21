<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    public function pasien()
    {
    return $this->belongsTo(
        Pasien::class,
        'nik_pasien',
        'nik_pasien'
    );
    }
    use HasFactory;

    protected $table = 'kunjungans';

    protected $primaryKey = 'id_kunjungan';

    protected $fillable = [

        'kode_kunjungan',

        'nik_pasien',

        'nama_pasien',

        'no_rekam_medis',

        'usia',

        'jenis_kelamin',

        'status_pasien',

        'jenis_jaminan',

        'no_bpjs',

        'poli_tujuan',

        'desa',

        'rt',

        'rw',

        'nama_kk',

        'surat_keterangan',

        'keterangan_surat',

        'no_hp',

        'deskripsi_alamat',

        'status_kunjungan',

        'tanggal_kunjungan',

    ];
}