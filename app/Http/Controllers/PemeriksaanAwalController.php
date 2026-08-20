<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Kunjungan;
use App\Models\Antrian;
use Illuminate\Http\Request;

class PemeriksaanAwalController extends Controller
{
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
        'pemeriksaan.awal.index',
        compact('polis')
    );
    }

    public function poli($namaPoli)
{
    // ==========================
    // ANTRIAN PRIORITAS
    // ==========================

    $prioritas = Kunjungan::where('poli_tujuan', $namaPoli)
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Awal')
        ->where('jenis_antrian', 'Prioritas')
        ->orderBy('kode_kunjungan')
        ->get();


    // ==========================
    // ANTRIAN REGULER
    // ==========================

    $reguler = Kunjungan::where('poli_tujuan', $namaPoli)
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Awal')
        ->where('jenis_antrian', 'Reguler')
        ->orderBy('kode_kunjungan')
        ->get();


    return view(
        'pemeriksaan.awal.poli',
        compact(
            'namaPoli',
            'prioritas',
            'reguler'
        )
    );
}

    public function create($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

    return view(
        'pemeriksaan.awal.create',
        compact('kunjungan')
    );
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_kunjungan'   => 'required',
            'jenis_antrian'    => 'required',
            'berat_badan'    => 'required',
            'tinggi_badan'   => 'required',
            'lingkar_perut'  => 'required',
            'tekanan_darah'  => 'required',
            'suhu'           => 'required',
            'nadi'           => 'required',
            'respirasi'      => 'required',
            'keluhan'        => 'required',
        ]);

        Pemeriksaan::create([

            'id_kunjungan'      => $request->id_kunjungan,
            'jenis_antrian'      => $request->jenis_antrian,

            'berat_badan'       => $request->berat_badan,

            'tinggi_badan'      => $request->tinggi_badan,

            'lingkar_perut'     => $request->lingkar_perut,

            'tekanan_darah'     => $request->tekanan_darah,

            'suhu'              => $request->suhu,

            'nadi'              => $request->nadi,

            'respirasi'         => $request->respirasi,

            'keluhan'           => $request->keluhan,

            'triase'            => $request->triase,
            'risiko_jatuh'      => $request->risiko_jatuh,
            'kondisi_khusus'    => $request->kondisi_khusus,
            'alergi'            => $request->alergi,
            'objektif'          => $request->objektif,
            'assessment'        => $request->assessment,

            // nanti diisi dokter
            

            'status_pemeriksaan' => 'Menunggu Pemeriksaan Poli'

        ]);
        

        Kunjungan::where(
            'id_kunjungan',
            $request->id_kunjungan
        )->update([
            'status_kunjungan' => 'Menunggu Pemeriksaan Poli'
        ]);

        return redirect()
            ->route('pemeriksaan.awal.index')
            ->with(
                'success',
                'Pemeriksaan awal berhasil disimpan.'
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