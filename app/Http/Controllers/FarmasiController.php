<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Pemeriksaan;
use App\Models\RiwayatPenyerahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FarmasiController extends Controller
{
    public function farmasi()
    {
        return view('farmasi');
    }

    public function penyerahan()
    {
        $reseps = Resep::with([
            'pemeriksaan.kunjungan.pasien',
            'detailObat.obat'
        ])
        ->where('status', 'Menunggu Penyiapan')
        ->get();

        return view('farmasi.ObatKeluar.index', compact('reseps'));
    }

    public function create($id)
{
    $resep = Resep::with([
        'pemeriksaan.kunjungan.pasien',
        'detailObat.obat'
    ])->findOrFail($id);

    return view(
        'farmasi.ObatKeluar.create',
        compact('resep')
    );
}

   public function store(Request $request)
{
    DB::transaction(function () use ($request) {

        $resep = Resep::with('detailObat.obat')
            ->findOrFail($request->id_resep);

        foreach ($resep->detailObat as $detail) {

            $detail->obat->decrement(
                'stok',
                $detail->jumlah
            );

        }

        $resep->update([
            'status' => 'Selesai'
        ]);

        RiwayatPenyerahan::create([
            'id_resep' => $resep->id_resep,
            'tanggal_penyerahan' => now(),
            
        ]);

    });

    return redirect()
        ->route('farmasi.riwayat.index')
        ->with(
            'success',
            'Obat berhasil diserahkan.'
        );
}

    public function obatKeluar()
    {
        return view('farmasi.ObatKeluar.index');
    }

   public function riwayat()
{
    $riwayats = RiwayatPenyerahan::with([
        'resep.pemeriksaan.kunjungan.pasien',
        'resep.detailObat.obat'
    ])
    ->latest('tanggal_penyerahan')
    ->get();

    return view(
        'farmasi.riwayat.index',
        compact('riwayats')
    );
}

public function showRiwayat($id)
{
    $riwayat = RiwayatPenyerahan::with([
        'resep.pemeriksaan.kunjungan.pasien',
        'resep.detailObat.obat'
    ])->findOrFail($id);

    return view(
        'farmasi.riwayat.show',
        compact('riwayat')
    );
}
}