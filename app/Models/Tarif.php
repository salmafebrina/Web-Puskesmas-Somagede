<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $primaryKey = 'id_tarif';

    protected $fillable = [
        'kode_tarif',
        'nama_tarif',
        'kategori_tarif',
        'biaya_tarif',
        'status_tarif'
    ];
}