<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_antrian';

    protected $fillable = [
        'nik_pasien',
        'kode_antrian',
        'status_kondisi',
        'poli_tujuan',
        'jenis_jaminan',
        'jenis_antrian',
        'tanggal_kunjungan',
        'usia',
        'status_pasien',
        'status_antrian'
    ];
}