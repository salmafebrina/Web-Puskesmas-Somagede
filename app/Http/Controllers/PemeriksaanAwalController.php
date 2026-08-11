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
    // Daftar poli tetap. Kalau ada poli baru, tinggal tambah di sini.
    $daftarPoli = [
        'Poli Umum',
        'Poli Gigi',
        'Poli KIA',
        'Poli Anak',
    ];

    // Hitung jumlah pasien menunggu pemeriksaan awal hari ini, per poli
    $jumlahPerPoli = Kunjungan::select('poli_tujuan')
        ->selectRaw('COUNT(*) as jumlah_pasien')
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Awal')
        ->groupBy('poli_tujuan')
        ->pluck('jumlah_pasien', 'poli_tujuan'); // hasil: ['Poli Umum' => 3, 'Poli Gigi' => 1, ...]

    // Gabungkan: semua poli tetap muncul, default 0 kalau belum ada pasien
    $polis = collect($daftarPoli)->map(function ($namaPoli) use ($jumlahPerPoli) {
        return (object) [
            'poli_tujuan'   => $namaPoli,
            'jumlah_pasien' => $jumlahPerPoli->get($namaPoli, 0),
        ];
    });

    return view('pemeriksaan.awal.index', compact('polis'));
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

    public function poli($namaPoli)
{
    $prioritas = collect();

    $reguler = Kunjungan::where('poli_tujuan', $namaPoli)
        ->whereDate('tanggal_kunjungan', today())
        ->where('status_kunjungan', 'Menunggu Pemeriksaan Awal')
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