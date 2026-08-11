<?php

namespace App\Http\Controllers;

use App\Models\Resep;

class ResepController extends Controller
{
    public function show($id)
    {
        $resep = Resep::with([
            'detailPenggunaanObat.obat'
        ])->findOrFail($id);

        return view(
            'pemeriksaan.resep.show',
            compact('resep')
        );
    }
}