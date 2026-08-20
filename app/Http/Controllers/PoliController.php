<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Resep;
use App\Models\DetailPenggunaanObat;
use App\Models\Laboratorium;
use App\Models\DetailLab;
use App\Models\Rujukan;

class PoliController extends Controller
{


public function dashboard()
{
    // =============================
    // PASIEN MENUNGGU PER POLI
    // HANYA UNTUK HARI INI
    // =============================

    $jumlahPoliUmum = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli Umum')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    $jumlahPoliGigi = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli Gigi')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    $jumlahPoliKia = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli KIA')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    $jumlahPoliKb = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli KB')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    $jumlahPoliGizi = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli Gizi')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    $jumlahPoliSanitarian = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli Sanitarian')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    $jumlahPoliMtbs = Kunjungan::whereDate(
        'tanggal_kunjungan',
        today()
    )
    ->where('poli_tujuan', 'Poli MTBS')
    ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
    ->count();


    return view(
        'pemeriksaan.dashboard',
        compact(
            'jumlahPoliUmum',
            'jumlahPoliGigi',
            'jumlahPoliKia',
            'jumlahPoliKb',
            'jumlahPoliGizi',
            'jumlahPoliSanitarian',
            'jumlahPoliMtbs'
        )
    );
}
   public function index()
{
    $daftarPoli = [
        'Poli Umum',
        'Poli Gigi',
        'Poli KIA',
        'Poli KB',
        'Poli Gizi',
        'Poli Sanitarian',
        'Poli MTBS',
    ];

    $jumlahPerPoli = Kunjungan::select('poli_tujuan')
        ->selectRaw('COUNT(*) as jumlah_pasien')
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
        ->groupBy('poli_tujuan')
        ->pluck('jumlah_pasien', 'poli_tujuan');

    $polis = collect($daftarPoli)->map(function ($namaPoli) use ($jumlahPerPoli) {

        return (object) [
            'poli_tujuan'   => $namaPoli,
            'jumlah_pasien' => $jumlahPerPoli->get($namaPoli, 0),
        ];

    });

    return view(
        'pemeriksaan.poli.index',
        compact('polis')
    );
}

public function poli($namaPoli)
{
    $prioritas = Kunjungan::with('pasien')
        ->where('poli_tujuan', $namaPoli)
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
        ->where('jenis_antrian', 'Prioritas')
        ->orderBy('created_at')
        ->get();

    $reguler = Kunjungan::with('pasien')
        ->where('poli_tujuan', $namaPoli)
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Poli')
        ->where('jenis_antrian', 'Reguler')
        ->orderBy('created_at')
        ->get();

    return view(
        'pemeriksaan.poli.daftar',
        compact(
            'namaPoli',
            'prioritas',
            'reguler'
        )
    );
}

public function create($id)
{
    $obats = Obat::orderBy('nama_obat')->get();

    $tarifs = Tarif::whereNotIn('kategori', [
        'Pemeriksaan Penunjang Laboratorium',
    ])
    ->orderBy('sub_kategori')
    ->orderBy('jenis_tindakan')
    ->get();

    $kunjungan = Kunjungan::with([
        'pasien',
        'pemeriksaan'
    ])->findOrFail($id);

    $detailLabs = DetailLab::orderBy('kategori_lab')
        ->orderBy('jenis_pemeriksaan_lab')
        ->get();

    return view(
        'pemeriksaan.poli.create',
        compact(
            'kunjungan',
            'obats',
            'tarifs',
            'detailLabs'
        )
    );
}

   public function store(Request $request)
{
    $request->validate([
        'id_pemeriksaan' => 'required',
        'id_kunjungan'   => 'required',
        'objektif'       => 'required',
        'assessment'     => 'required',
        'kode_icd10'     => 'required',
        'diagnosa'       => 'required',
    ]);

    DB::transaction(function () use ($request) {

        $pemeriksaan = Pemeriksaan::findOrFail(
            $request->id_pemeriksaan
        );

        $pemeriksaan->update([

            'objektif' => $request->objektif,
            'retraksi' => $request->retraksi,
            'stridor' => $request->stridor,
            'skala_nyeri' => $request->skala_nyeri,
            'assessment' => $request->assessment,
            'kode_icd10' => $request->kode_icd10,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan
                            ? implode(',', $request->tindakan)
                            : null,
            'kie' => $request->kie,
            'plan' => $request->plan
                            ? implode(',', $request->plan)
                            : null,
            'status_pemeriksaan' => 'Selesai',
        ]);

        // ===========================
        // RIWAYAT MEDIS
        // ===========================

        //$riwayat = RiwayatMedis::create([

          //  'id_kunjungan' => $request->id_kunjungan,
         //   'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,

           // 'objektif' => $request->objektif,
            // 'assessment' => $request->assessment,
            // 'kode_icd10' => $request->kode_icd10,
           // 'diagnosa' => $request->diagnosa,
           // 'tindakan' => $pemeriksaan->tindakan,
          //  'kie' => $request->kie,

        //]);

        // ===========================
        // RESEP
        // ===========================

        if(in_array('Resep', $request->plan ?? []))
        {
            $resep = Resep::create([

            'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,

            'tanggal_resep' => now(),

            'catatan' => $request->catatan,

            'status' => 'Menunggu Penyiapan'

            ]);

            if($request->obat)
            {
                foreach($request->obat as $i => $obat)
                {
                    DetailPenggunaanObat::create([

                        'id_resep' => $resep->id,

                        'id_obat' => $obat,

                        'jumlah' => $request->jumlah[$i],

                        'aturan_pakai' => $request->aturan_pakai[$i] ?? null,

                    ]);
                }
            }
        }

        // ===========================
        // LABORATORIUM
        // ===========================

        
        if(in_array('Laboratorium', $request->plan ?? []))
        {
            
            Laboratorium::create([
                'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,
                'tanggal' => now(),
                'nomor_rm' => $request->nomor_rm,
                'nama_pasien' => $request->nama_pasien,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'umur' => $request->umur,
                'status' => $request->status,
                'jenis_pemeriksaan_lab' => $request->jenis_pemeriksaan_lab,
                'jenis_jaminan' => $request->jenis_jaminan
            ]);
        }

        // ===========================
        // RUJUKAN
        // ===========================

        if(in_array('Rujukan', $request->plan ?? []))
        {
            Rujukan::create([
                'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,

                'tujuan_rujukan' => $request->tujuan_rujukan,

                'alasan_rujukan' => $request->alasan_rujukan,

            ]);
        }

        Kunjungan::where(
            'id_kunjungan',
            $request->id_kunjungan
        )->update([
            'status_kunjungan' => 'Menunggu Pembayaran'
        ]);

    });

    return redirect()
        ->route('pemeriksaan.poli.index')
        ->with(
            'success',
            'Pemeriksaan berhasil disimpan.'
        );
}

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}