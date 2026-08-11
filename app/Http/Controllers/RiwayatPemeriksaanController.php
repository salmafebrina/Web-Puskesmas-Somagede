<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class RiwayatPemeriksaanController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with([
            'pasien',
            'pemeriksaan'
        ])
        ->whereHas('pemeriksaan')
        ->latest()
        ->get();

        return view(
            'pemeriksaan.riwayat.index',
            compact('kunjungans')
        );
    }

    public function show($id)
    {
        $kunjungan = Kunjungan::with([
            'pasien',
            'pemeriksaan'
        ])->findOrFail($id);

        return view(
            'pemeriksaan.riwayat.show',
            compact('kunjungan')
        );
    }
}

