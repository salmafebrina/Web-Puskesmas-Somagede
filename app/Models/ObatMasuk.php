<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObatMasuk extends Model
{
    protected $primaryKey = 'id_obat_masuk';

    protected $fillable = [

        'id_obat',

        'tanggal_masuk',

        'jumlah_masuk',

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
}