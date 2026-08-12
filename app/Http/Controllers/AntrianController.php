<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {

    $antrians = Antrian::whereDate(
    'created_at',
    Carbon::today()
    )
    ->orderBy('created_at')
    ->get();

        $jumlahReguler = Antrian::where('jenis_antrian', 'Reguler')
            ->whereDate('tanggal_kunjungan', today())
            ->count();

        $jumlahPrioritas = Antrian::where('jenis_antrian', 'Prioritas')
            ->whereDate('tanggal_kunjungan', today())
            ->count();

        return view(
            'pendaftaran.antrian.index',
            compact(
                'antrians',
                'jumlahReguler',
                'jumlahPrioritas'
            )
        );
    }

    public function cariPasien(Request $request)
{
    $keyword = $request->keyword;

    $pasien = Pasien::where('nik_pasien', 'like', "%$keyword%")
        ->orWhere('nama_pasien', 'like', "%$keyword%")
        ->limit(5)
        ->get();

    return response()->json($pasien);
}

    public function create()
    {
        return view('pendaftaran.antrian.create');
    }

    public function cekPasien($nik)
    {
    $pasien = Pasien::where('nik_pasien', $nik)->first();

    if (!$pasien) {
        return response()->json([
            'status' => false
        ]);
    }

    return response()->json([

    'status'=>true,

    'id_pasien'=>$pasien->id_pasien,

    'tanggal_lahir'=>$pasien->tanggal_lahir,

    'status_registrasi'=>$pasien->status_registrasi

]);
}
    public function store(Request $request)
{
    $request->validate([
        'nik_pasien' => 'required',
        'tanggal_lahir' => 'required',
        'status_kondisi' => 'required',
        'poli_tujuan' => 'required',
        'jenis_jaminan' => 'required',
    ]);

    $pasien = Pasien::where('nik_pasien', $request->nik_pasien)->first();

    if ($request->filled('id_pasien')) {

    $pasien = Pasien::find($request->id_pasien);

    $statusPasien = 'Pasien Lama';

    } else {

    $pasien = Pasien::create([

        'nik_pasien' => $request->nik_pasien,

        'tanggal_lahir' => $request->tanggal_lahir,

        'status_registrasi' => 'draft',

    ]);

    $statusPasien = 'Pasien Baru';
    }

    $lahir = Carbon::parse($request->tanggal_lahir);
    $sekarang = Carbon::now();

    $umur = $lahir->diff($sekarang);

    $usia =
        $umur->y . " Tahun " .
        $umur->m . " Bulan " .
        $umur->d . " Hari";

    if (
    $umur->y < 2 ||
    $umur->y >= 60 ||
    $request->status_kondisi != 'Normal'
    ) {
    $jenisAntrian = 'Prioritas';
    } else {
    $jenisAntrian = 'Reguler';
}

    $prefix = $jenisAntrian == 'Reguler'
        ? 'C'
        : 'P';

    $jumlah = Antrian::whereDate(
            'tanggal_kunjungan',
            $request->tanggal_kunjungan
        )
        ->where(
            'jenis_antrian',
            $jenisAntrian
        )
        ->count() + 1;

    $kodeAntrian =
        $prefix .
        str_pad(
            $jumlah,
            3,
            '0',
            STR_PAD_LEFT
        );

    $antrian = Antrian::create([

        'nik_pasien' => $request->nik_pasien,
        'kode_antrian' => $kodeAntrian,
        'poli_tujuan' => $request->poli_tujuan,
        'jenis_jaminan' => $request->jenis_jaminan,
        'status_kondisi' => $request->status_kondisi,
        'jenis_antrian' => $jenisAntrian,
        'tanggal_kunjungan' => $request->tanggal_kunjungan,
        'usia' => $usia,
        'status_pasien' => $statusPasien,
        'status_antrian' => 'Menunggu',

    ]);

    return redirect()->route(
        'antrian.show',
        $antrian->id_antrian
    );
    }

    public function show($id)
    {
        $antrian = Antrian::findOrFail($id);

        return view(
            'pendaftaran.antrian.show',
            compact('antrian')
        );
    }
}