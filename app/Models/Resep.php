<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model

{


    protected $primaryKey = 'id_resep';

    protected $fillable = [
        'id_pemeriksaan',
        'tanggal_resep',
        'kode_resep',
        'catatan',
        'status'
    ];

    public function detailObat()
    {
        return $this->hasMany(
            DetailPenggunaanObat::class,
            'id_resep'
        );
    }

    public function pemeriksaan()
    {
    return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }
}