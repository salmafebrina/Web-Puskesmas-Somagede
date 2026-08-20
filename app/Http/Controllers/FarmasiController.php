<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Pemeriksaan;
use App\Models\RiwayatPenyerahan;
use App\Models\Kunjungan;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FarmasiController extends Controller
{
    public function farmasi()
{
    // =============================
    // RESEP MENUNGGU
    // =============================

    $resepMenunggu = Kunjungan::where(
        'status_kunjungan',
        'Menunggu Pembayaran'
    )->count();


    // =============================
    // PASIEN SELESAI HARI INI
    // =============================

    $pasienSelesai = Kunjungan::whereDate(
        'updated_at',
        today()
    )
    ->where(
        'status_kunjungan',
        'Selesai'
    )
    ->count();


    // =============================
    // STOK OBAT MENIPIS
    // =============================

    $stokMenipis = Obat::whereColumn(
        'stok_obat',
        '<=',
        'stok_minimum'
    )
    ->orderBy('stok_obat')
    ->get();


    return view(
        'farmasi',
        compact(
            'resepMenunggu',
            'pasienSelesai',
            'stokMenipis'
        )
    );
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

   public function riwayat(Request $request)
{
    // Default tampilkan riwayat hari ini
    $tanggal = $request->tanggal ?? now()->toDateString();

    $riwayats = RiwayatPenyerahan::with([
        'resep.pemeriksaan.kunjungan.pasien',
        'resep.detailObat.obat'
    ])
    ->whereDate('tanggal_penyerahan', $tanggal)
    ->latest('tanggal_penyerahan')
    ->get();

    return view(
        'farmasi.riwayat.index',
        compact(
            'riwayats',
            'tanggal'
        )
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