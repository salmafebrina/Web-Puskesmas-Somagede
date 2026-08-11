<?php

namespace App\Http\Controllers;

use App\Models\Rujukan;
use App\Models\Pemeriksaan;

class RujukanController extends Controller
{
    /**
     * Daftar pasien rujukan
     */

public function index()
{
    $pemeriksaans = Pemeriksaan::with([
        'kunjungan.pasien'
    ])
    ->where('plan', 'LIKE', '%Rujukan%')
    ->latest()
    ->get();

    return view(
        'pemeriksaan.riwayat.index_rujukan',
        compact('pemeriksaans')
    );
}

    /**
     * Detail surat rujukan
     */
    public function show($id)
    {
        $rujukan = Rujukan::findOrFail($id);

        return view(
            'rujukan.show',
            compact('rujukan')
        );
    }
}