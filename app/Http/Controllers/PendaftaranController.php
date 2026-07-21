<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran');
    }


public function daftar()
{
    $antrianPrioritas = Antrian::where('status_antrian', 'Menunggu')
        ->where('jenis_antrian', 'Prioritas')
        ->orderBy('created_at')
        ->get();

    $antrianReguler = Antrian::where('status_antrian', 'Menunggu')
        ->where('jenis_antrian', 'Reguler')
        ->orderBy('created_at')
        ->get();

    return view('pendaftaran.daftar.index', [
        'antrianPrioritas' => $antrianPrioritas,
        'antrianReguler'   => $antrianReguler,
        'jumlahPrioritas'  => $antrianPrioritas->count(),
        'jumlahReguler'    => $antrianReguler->count(),
    ]);
}


public function pasien()
{
    return $this->belongsTo(
        Pasien::class,
        'nik_pasien',
        'nik_pasien'
    );
}

public function riwayat(Request $request)
{
    $tanggal = $request->tanggal ?: now()->toDateString();

    $kunjungans = Kunjungan::with('pasien')
        ->whereDate('tanggal_kunjungan', $tanggal)
        ->latest()
        ->get();

    return view(
        'pendaftaran.riwayat.index',
        compact('kunjungans', 'tanggal')
    );
}

public function show($id)
{
    $kunjungan = Kunjungan::findOrFail($id);

    return view(
        'pendaftaran.riwayat.show',
        compact('kunjungan')
    );
}

public function edit($id)
{
    $kunjungan = Kunjungan::findOrFail($id);

    return view(
        'pendaftaran.riwayat.edit',
        compact('kunjungan')
    );
}

public function update(Request $request, $id)
{
    $request->validate([
        'jenis_jaminan'    => 'required',
        'poli_tujuan'      => 'required',
        'surat_keterangan' => 'required',
    ]);

    $kunjungan = Kunjungan::findOrFail($id);

    $kunjungan->update([

        'jenis_jaminan'    => $request->jenis_jaminan,

        'no_bpjs'          => $request->no_bpjs,

        'poli_tujuan'      => $request->poli_tujuan,

        'surat_keterangan' => $request->surat_keterangan,

        'rt'               => $request->rt,

        'rw'               => $request->rw,

    ]);

    return redirect()
        ->route('pendaftaran.riwayat.index')
        ->with(
            'success',
            'Data berhasil diperbarui.'
        );
}

}