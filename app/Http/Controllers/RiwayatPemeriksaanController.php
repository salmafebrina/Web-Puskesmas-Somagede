<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class RiwayatPemeriksaanController extends Controller
{
    public function index(Request $request)
{
    // Default tampilkan pemeriksaan hari ini
    $tanggal = $request->tanggal ?: now()->toDateString();

    $pemeriksaans = Pemeriksaan::with([
        'kunjungan.pasien'
    ])
    ->whereDate('created_at', $tanggal)
    ->where('status_pemeriksaan', 'Selesai')
    ->latest()
    ->get();

    return view(
        'pemeriksaan.riwayat.index',
        compact(
            'pemeriksaans',
            'tanggal'
        )
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

