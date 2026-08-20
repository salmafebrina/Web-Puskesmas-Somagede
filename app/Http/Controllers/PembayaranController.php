<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\Kunjungan;
use App\Models\TransaksiPembayaran;
use App\Models\Laboratorium;
use App\Models\DetailLab;
use App\Models\Resep;
use App\Models\DetailPenggunaanObat;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{

public function index()
{
    $kunjungans = Kunjungan::with([
        'pasien',
        'pemeriksaan'
    ])
    ->where('status_kunjungan', 'Menunggu Pembayaran')
    ->latest()
    ->get();

    return view('pembayaran.transaksi.index', compact('kunjungans'));
}

public function show($id)
{
    $kunjungan = Kunjungan::with([
        'pasien',
        'pemeriksaan'
    ])->findOrFail($id);

    $pemeriksaan = $kunjungan->pemeriksaan;

    $detailTindakan = [];
    $totalTindakan = 0;
    $detailPenunjang = [];
    $totalPenunjang = 0;
    $detailObat = [];
    $totalObat = 0;
    $totalAmbulance = 0;
    $detailAmbulance = [];
    $grandTotal = $totalTindakan + $totalPenunjang + $totalObat + $totalAmbulance;


    if ($pemeriksaan && !empty($pemeriksaan->tindakan)) {

        $idTarifs = explode(',', $pemeriksaan->tindakan);

        foreach ($idTarifs as $idTarif) {

            $tarif = Tarif::find(trim($idTarif));

            if ($tarif) {

                $detailTindakan[] = [
                    'id' => $tarif->id_tarif,
                    'nama' => $tarif->jenis_tindakan,
                    'kategori' => $tarif->kategori,
                    'sub_kategori' => $tarif->sub_kategori,
                    'tarif' => $tarif->tarif,
                ];

                $totalTindakan += $tarif->tarif;
            }
        }
    }

    // =============================
// PEMERIKSAAN PENUNJANG
// =============================

$laboratorium = Laboratorium::where(
    'id_pemeriksaan',
    $pemeriksaan->id_pemeriksaan
)->first();

if ($laboratorium) {

    $detailLabs = DetailLab::where(
        'id_laboratorium', $laboratorium->id_laboratorium
    )->get();

    foreach ($detailLabs as $lab) {

        if ($lab->masterLab) {

            // cari tarif berdasarkan nama pemeriksaan
            $tarif = Tarif::where(
                'jenis_tindakan',
                $lab->masterLab->jenis_pemeriksaan_lab
            )->first();

            $harga = $tarif ? $tarif->tarif : 0;

            $detailPenunjang[] = [

                'nama' => $lab->masterLab->jenis_pemeriksaan_lab,

                'kategori' => $lab->masterLab->kategori_lab,

                'tarif' => $harga,

            ];

            $totalPenunjang += $harga;

        }

    }

}

// =============================
// OBAT
// =============================

$detailObat = [];
$totalObat = 0;

$resep = \App\Models\Resep::where(
    'id_pemeriksaan',
    $pemeriksaan->id_pemeriksaan
)->first();

if ($resep) {

    $detailResep = \App\Models\DetailPenggunaanObat::with('obat')
        ->where('id_resep', $resep->id)
        ->get();

    foreach ($detailResep as $item) {

        if ($item->obat) {

            $subtotal = $item->jumlah * $item->obat->harga;

            $detailObat[] = [

                'nama' => $item->obat->nama_obat,

                'jumlah' => $item->jumlah,

                'harga' => $item->obat->harga,

                'subtotal' => $subtotal,

            ];

            $totalObat += $subtotal;

        }

    }

}
$ambulance = Tarif::where('kategori', 'Ambulance')->get();

foreach ($ambulance as $item){

    $detailAmbulance[] = [
        'nama' => $item->jenis_tindakan,
        'tarif' => $item->tarif,
    ];

    $totalAmbulance += $item->tarif;
}


    return view('pembayaran.transaksi.show', compact(
    'kunjungan',
    'detailTindakan',
    'totalTindakan',
    'detailPenunjang',
    'totalPenunjang',
    'detailAmbulance',
    'totalAmbulance',
    'detailObat',
    'totalObat',
    'grandTotal'
    ));
    }

   public function dashboard()
{
    // =============================
    // MENUNGGU PEMBAYARAN
    // =============================

    $menungguPembayaran = Kunjungan::where(
        'status_kunjungan',
        'Menunggu Pembayaran'
    )->count();


    // =============================
    // TRANSAKSI HARI INI
    // =============================

    $transaksiHariIni = TransaksiPembayaran::whereDate(
        'tanggal_pembayaran',
        today()
    )->count();


    // =============================
    // PENDAPATAN HARI INI
    // =============================

    $pendapatanHariIni = TransaksiPembayaran::whereDate(
        'tanggal_pembayaran',
        today()
    )
    ->where(
        'status_pembayaran',
        'Lunas'
    )
    ->sum('total_pembayaran');


    // =============================
    // PEMBAYARAN SELESAI
    // =============================

    $pembayaranSelesai = TransaksiPembayaran::whereDate(
        'tanggal_pembayaran',
        today()
    )
    ->where(
        'status_pembayaran',
        'Lunas'
    )
    ->count();


    return view(
        'pembayaran.dashboard',
        compact(
            'menungguPembayaran',
            'transaksiHariIni',
            'pendapatanHariIni',
            'pembayaranSelesai'
        )
    );
}
    public function store(Request $request, $id)
{
    $request->validate([
        'metode_pembayaran' => 'required',
        'nominal_bayar' => 'required|numeric'
    ]);

    $kunjungan = Kunjungan::with('pemeriksaan')->findOrFail($id);
    $pemeriksaan = $kunjungan->pemeriksaan;
    $totalTindakan = 0;
    $totalPenunjang = 0;
    $totalObat = 0;
    $totalAmbulance = 0;
    $total = $totalTindakan
        + $totalPenunjang
        + $totalObat
        + $totalAmbulance;
    $detailPenunjang = [];
    $totalPenunjang = 0;

   $laboratorium = Laboratorium::where(
    'id_pemeriksaan',
    $pemeriksaan->id_pemeriksaan
)->first();

if ($laboratorium) {

    $detailLabs = DetailLab::where(
        'id_laboratorium', $laboratorium->id_laboratorium
    )->get();

    foreach ($detailLabs as $lab) {

        if ($lab->masterLab) {

            $detailPenunjang[] = [

                'kategori' => $lab->masterLab->kategori_lab,

                'nama' => $lab->masterLab->jenis_pemeriksaan_lab,

                // sementara tarif = 0 dulu
                // nanti kita sambungkan ke master tarif
                'tarif' => 0,

            ];

            $totalPenunjang += 0;

        }

    }

}

    $transaksi = TransaksiPembayaran::create([

    'id_kunjungan' => $kunjungan->id_kunjungan,

    'no_transaksi' => 'TRX'.date('YmdHis'),

    'tanggal_pembayaran' => now(),

    'metode_pembayaran' => $request->metode_pembayaran,

    'total_pembayaran' => $total,

    'nominal_bayar' => $request->nominal_bayar,

    'kembalian' => $request->nominal_bayar - $total,

    'status_pembayaran' => 'Lunas',
    ]);

    $kunjungan->update([
        'status_kunjungan' => 'Selesai'
    ]);

   return redirect()
    ->route('pembayaran.riwayat.index', $kunjungan->id_kunjungan)
    ->with([
        'success' => 'Pembayaran berhasil',
        'id_kunjungan' => $kunjungan->id_kunjungan,
        'show_modal' => true
    ]);
}

    public function selesai($id)
{
    $transaksi = TransaksiPembayaran::findOrFail($id);

    $transaksi->update([
        'status_pembayaran'=>'Lunas'
    ]);

    $transaksi->kunjungan->update([
        'status_kunjungan'=>'Selesai'
    ]);

    return redirect()
        ->route('pembayaran.riwayat')
        ->with(
            'success',
            'Transaksi selesai'
        );
}

public function cetak($id)
{
    $kunjungan = Kunjungan::with([
        'pasien',
        'pemeriksaan'
    ])->findOrFail($id);

    $transaksi = TransaksiPembayaran::where(
        'id_kunjungan',
        $id
    )->first();

    return view(
        'pembayaran.transaksi.cetak',
        compact('kunjungan', 'transaksi')
    );
}

    public function riwayat(Request $request)
{
    $query = TransaksiPembayaran::with([
        'kunjungan.pasien'
    ]);

    // Filter tanggal
    if ($request->filled('tanggal')) {

        $query->whereDate(
            'tanggal_pembayaran',
            $request->tanggal
        );

    } else {

        $query->whereDate(
            'tanggal_pembayaran',
            now()->toDateString()
        );

    }

    // Filter pencarian
    if ($request->filled('search')) {

        $query->whereHas('kunjungan.pasien', function ($q) use ($request) {

            $q->where(
                'nama_pasien',
                'like',
                '%' . $request->search . '%'
            );

        });

    }

    $transaksis = $query
        ->latest()
        ->get();

    return view(
        'pembayaran.riwayat.index',
        compact('transaksis')
    );
    }

   public function showRiwayat($id)
{
    $transaksi = TransaksiPembayaran::with([
        'kunjungan.pasien',
        'kunjungan.pemeriksaan'
    ])->findOrFail($id);

    $kunjungan = $transaksi->kunjungan;
    $pemeriksaan = $kunjungan->pemeriksaan;

    // =============================
    // Pemeriksaan Klinis
    // =============================

    $detailTindakan = [];
    $totalTindakan = 0;

    if ($pemeriksaan && !empty($pemeriksaan->tindakan)) {

        $idTarifs = explode(',', $pemeriksaan->tindakan);

        foreach ($idTarifs as $idTarif) {

            $tarif = Tarif::find(trim($idTarif));

            if ($tarif) {

                $detailTindakan[] = [
                    'nama' => $tarif->jenis_tindakan,
                    'tarif' => $tarif->tarif,
                ];

                $totalTindakan += $tarif->tarif;
            }
        }
    }

    // =============================
    // Pemeriksaan Penunjang
    // =============================

    $detailPenunjang = [];
    $totalPenunjang = 0;

    $laboratorium = Laboratorium::where(
        'id_pemeriksaan',
        $pemeriksaan->id_pemeriksaan
    )->first();

    if ($laboratorium) {

        $detailLabs = DetailLab::where(
            'id_laboratorium',
            $laboratorium->id_laboratorium
        )->get();

        foreach ($detailLabs as $lab) {

            if ($lab->masterLab) {

                $tarif = Tarif::where(
                    'jenis_tindakan',
                    $lab->masterLab->jenis_pemeriksaan_lab
                )->first();

                $harga = $tarif ? $tarif->tarif : 0;

                $detailPenunjang[] = [
                    'nama' => $lab->masterLab->jenis_pemeriksaan_lab,
                    'tarif' => $harga,
                ];

                $totalPenunjang += $harga;
            }
        }
    }

    // =============================
    // Obat
    // =============================

    $detailObat = [];
    $totalObat = 0;

    $resep = Resep::where(
        'id_pemeriksaan',
        $pemeriksaan->id_pemeriksaan
    )->first();

    if ($resep) {

        $detailResep = DetailPenggunaanObat::with('obat')
            ->where('id_resep', $resep->id)
            ->get();

        foreach ($detailResep as $item) {

            if ($item->obat) {

                $subtotal = $item->jumlah * $item->obat->harga;

                $detailObat[] = [
                    'nama' => $item->obat->nama_obat,
                    'jumlah' => $item->jumlah,
                    'harga' => $item->obat->harga,
                    'subtotal' => $subtotal,
                ];

                $totalObat += $subtotal;
            }
        }
    }

    // =============================
    // Ambulance
    // =============================

    $detailAmbulance = [];
    $totalAmbulance = 0;

    $ambulance = Tarif::where('kategori', 'Ambulance')->get();

    foreach ($ambulance as $item) {

        $detailAmbulance[] = [
            'nama' => $item->jenis_tindakan,
            'tarif' => $item->tarif,
        ];

        $totalAmbulance += $item->tarif;
    }

    $grandTotal =
        $totalTindakan +
        $totalPenunjang +
        $totalObat +
        $totalAmbulance;

    return view(
        'pembayaran.riwayat.show',
        compact(
            'transaksi',
            'kunjungan',
            'detailTindakan',
            'totalTindakan',
            'detailPenunjang',
            'totalPenunjang',
            'detailObat',
            'totalObat',
            'detailAmbulance',
            'totalAmbulance',
            'grandTotal'
        )
    );
}
}

