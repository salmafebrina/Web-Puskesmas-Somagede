<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DetailPenggunaanObat extends Model
{

    protected $table = 'detail_penggunaan_obats';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_resep',
        'id_obat',
        'jumlah',
        'aturan_pakai'
    ];

    public function resep()
    {
        return $this->belongsTo(
            Resep::class,
            'id_resep'
        );
    }

    public function obat()
    {
        return $this->belongsTo(
            Obat::class,
            'id_obat'
        );
    }
}