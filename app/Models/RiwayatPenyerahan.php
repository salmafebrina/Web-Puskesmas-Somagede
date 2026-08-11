<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenyerahan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penyerahan';

    protected $primaryKey = 'id_penyerahan';

    protected $fillable = [
        'id_resep',
        'tanggal_penyerahan',
        'id_user'
    ];

    public function resep()
    {
        return $this->belongsTo(
            Resep::class,
            'id_resep',
            'id_resep'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}