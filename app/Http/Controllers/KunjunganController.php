<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Antrian;
use App\Models\Pasien;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PENDAFTARAN
    |--------------------------------------------------------------------------
    */

   public function index(Request $request)
    {
    $query = Kunjungan::query();

    if($request->filled('tanggal')){

        $query->whereDate(
            'tanggal_kunjungan',
            $request->tanggal
        );

    }

    $kunjungans = $query
        ->latest()
        ->get();

    return view(
        'pendaftaran.riwayat.index',
        compact('kunjungans')
    );
    }
    
    /*
    |--------------------------------------------------------------------------
    | FORM DAFTAR KUNJUNGAN
    |--------------------------------------------------------------------------
    */

    public function create($id)
    {
        $antrian = Antrian::findOrFail($id);

        $pasien = Pasien::where(
            'nik_pasien',
            $antrian->nik_pasien
        )->first();

        return view(
            'pendaftaran.daftar.create',
            compact(
                'antrian',
                'pasien'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KUNJUNGAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
    'nik_pasien'          => 'required',
    'tanggal_kunjungan'   => 'required',
    'status_pasien'       => 'required',
    'jenis_jaminan'       => 'required',
    'poli_tujuan'         => 'required',
    'surat_keterangan'    => 'required',
    'no_hp'               => 'nullable',
    'deskripsi_alamat'    => 'nullable',
    ]);

        $kodeKunjungan =
            'KJ' .
            str_pad(
                Kunjungan::count() + 1,
                4,
                '0',
                STR_PAD_LEFT
            );

        Kunjungan::create([

            'kode_kunjungan'   => $kodeKunjungan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,

            'nik_pasien'       => $request->nik_pasien,

            'nama_pasien'      => $request->nama_pasien,

            'no_rekam_medis'   => $request->no_rekam_medis,

            'usia'             => $request->usia,

            'jenis_kelamin'    => $request->jenis_kelamin,

            'status_pasien'    => $request->status_pasien,

            'jenis_jaminan'    => $request->jenis_jaminan,

            'no_bpjs'          => $request->no_bpjs,

            'poli_tujuan'      => $request->poli_tujuan,

            'desa'             => $request->desa,

            'rt'               => $request->rt,

            'rw'               => $request->rw,

            'nama_kk'          => $request->nama_kk,

            'surat_keterangan' => $request->surat_keterangan,
            'no_hp'            => $request->no_hp,
            'deskripsi_alamat' => $request->deskripsi_alamat,

            'status_kunjungan' => 'Menunggu Pemeriksaan Awal'

        ]);

        // Hilangkan dari daftar antrian
        Antrian::where(
            'id_antrian',
            $request->id_antrian
        )->update([
            'status_antrian' => 'Dipanggil'
        ]);

        return redirect()
            ->route('pendaftaran.riwayat.index')
            ->with(
                'success',
                'Kunjungan berhasil dibuat.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PENDAFTARAN
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        return view(
            'pendaftaran.riwayat.show',
            compact('kunjungan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PENDAFTARAN
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        return view(
            'pendaftaran.riwayat.edit',
            compact('kunjungan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PENDAFTARAN
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_jaminan'      => 'required',
            'poli_tujuan'        => 'required',
            'surat_keterangan'   => 'required',
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