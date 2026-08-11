<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class LaboratoriumController extends Controller
{
    /**
     * Menampilkan daftar pasien laboratorium
     */
public function index()
{
    $pemeriksaans = Pemeriksaan::with([
        'kunjungan.pasien'
    ])
    ->where('plan', 'LIKE', '%Laboratorium%')
    ->latest()
    ->get();

    return view(
        'pemeriksaan.riwayat.index_laboratorium',
        compact('pemeriksaans')
    );
}

    /**
     * Detail pasien laboratorium
     */
    public function show($id)
    {
        $laboratorium = Laboratorium::findOrFail($id);

        return view(
            'laboratorium.show',
            compact('laboratorium')
        );
    }

    /**
     * Simpan hasil laboratorium
     */
    public function update(Request $request, $id)
    {

    }
}