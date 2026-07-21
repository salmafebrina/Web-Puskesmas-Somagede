<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::where(
            'status_kunjungan',
            'Menunggu Pemeriksaan Poli'
        )
        ->latest()
        ->get();

        return view(
            'pemeriksaan.poli.index',
            compact('kunjungans')
        );
    }

    public function create($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        return view(
            'pemeriksaan.poli.create',
            compact('kunjungan')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kunjungan'   => 'required',
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

            'berat_badan'       => $request->berat_badan,

            'tinggi_badan'      => $request->tinggi_badan,

            'lingkar_perut'     => $request->lingkar_perut,

            'tekanan_darah'     => $request->tekanan_darah,

            'suhu'              => $request->suhu,

            'nadi'              => $request->nadi,

            'respirasi'         => $request->respirasi,

            'keluhan'           => $request->keluhan,

            // nanti diisi dokter
            'objektif'          => null,
            'assessment'        => null,
            'diagnosa'          => null,
            'kode_icd10'        => null,
            'tindakan'          => null,

            'status_pemeriksaan' => 'Menunggu Pemeriksaan Poli'

        ]);

        Kunjungan::where(
            'id_kunjungan',
            $request->id_kunjungan
        )->update([
            'status_kunjungan' => 'Menunggu Pemeriksaan Poli'
        ]);

        return redirect()
            ->route('pemeriksaan.poli.index')
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