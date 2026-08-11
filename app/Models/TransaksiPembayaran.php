<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    protected $table = 'transaksi_pembayarans';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_kunjungan',
        'no_transaksi',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'total_pembayaran',
        'nominal_bayar',
        'kembalian',
        'status_pembayaran',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(
            Kunjungan::class,
            'id_kunjungan',
            'id_kunjungan'
        );
    }
}