<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObatKeluar extends Model
{
    protected $primaryKey = 'id_obat_keluar';

    protected $fillable = [
        'id_obat',
        'id_kunjungan',
        'tanggal_keluar',
        'jumlah_keluar',
        'keterangan'
    ];

    public function obat()
    {
        return $this->belongsTo(
            Obat::class,
            'id_obat',
            'id_obat'
        );
    }

    public function kunjungan()
    {
        return $this->belongsTo(
            Kunjungan::class,
            'id_kunjungan',
            'id_kunjungan'
        );
    }
}