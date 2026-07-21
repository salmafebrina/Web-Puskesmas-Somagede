<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    public function kunjungan()
{
    return $this->belongsTo(
        Kunjungan::class,
        'id_kunjungan',
        'id_kunjungan'
    );
}
    protected $primaryKey = 'id_pemeriksaan';

    protected $fillable = [

        'id_kunjungan',

        'berat_badan',

        'tinggi_badan',

        'lingkar_perut',

        'tekanan_darah',

        'suhu',

        'nadi',

        'respirasi',

        'keluhan',

        'objektif',

        'assessment',

        'diagnosa',

        'kode_icd10',

        'tindakan',

        'status_pemeriksaan',

    ];
}