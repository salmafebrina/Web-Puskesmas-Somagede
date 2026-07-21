<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Antrian;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $search = request('search');

        $pasiens = Pasien::when($search, function ($query) use ($search) {

            $query->where('nik_pasien', 'like', "%{$search}%")
                  ->orWhere('nama_pasien', 'like', "%{$search}%");

        })->get();

        return view('pasien.index', compact('pasiens'));
    }

    public function create(Request $request)
{
    $nik = $request->nik;
    $id_antrian = $request->id_antrian;

    $lastRM = Pasien::max('id_rekam_medis');

    if (!$lastRM) {
        $nomorRM = '00001';
    } else {
        $nomorRM = str_pad(((int)$lastRM) + 1, 5, '0', STR_PAD_LEFT);
    }

    return view(
        'pasien.create',
        compact(
            'nik',
            'id_antrian',
            'nomorRM'
        )
    );
}
    public function store(Request $request)
{
    $request->validate([
        'id_rekam_medis'  => 'required',
        'nik_pasien'      => 'required',
        'nama_pasien'     => 'required',
        'nama_kk'         => 'required',
        'jenis_kelamin'   => 'required',
        'tanggal_lahir'   => 'required',
        'kode_desa'       => 'required',
        'no_hp'           => 'required',
        'alamat_pasien'   => 'required',
        'id_bpjs'         => 'nullable',
    ]);

    // Cek apakah pasien sudah ada
    $pasien = Pasien::where('nik_pasien', $request->nik_pasien)->first();

    if ($pasien) {

        // UPDATE pasien draft menjadi lengkap
        $pasien->update([
            'id_rekam_medis' => $request->id_rekam_medis,
            'nama_pasien'    => $request->nama_pasien,
            'nama_kk'        => $request->nama_kk,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'kode_desa'      => $request->kode_desa,
            'no_hp'          => $request->no_hp,
            'alamat_pasien'  => $request->alamat_pasien,
            'id_bpjs'        => $request->id_bpjs,
            'status_registrasi' => 'lengkap',
        ]);

    } else {

        // Pasien benar-benar baru
        $pasien = Pasien::create([
            'id_rekam_medis' => $request->id_rekam_medis,
            'nik_pasien'     => $request->nik_pasien,
            'nama_pasien'    => $request->nama_pasien,
            'nama_kk'        => $request->nama_kk,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'kode_desa'      => $request->kode_desa,
            'no_hp'          => $request->no_hp,
            'alamat_pasien'  => $request->alamat_pasien,
            'id_bpjs'        => $request->id_bpjs,
            'status_registrasi' => 'lengkap',
        ]);

    }

    return redirect()
        ->route('pendaftaran.daftar.index')
        ->with([
            'success'      => 'Data pasien berhasil disimpan.',
            'id_antrian'   => $request->id_antrian,
            'nama_pasien'  => $pasien->nama_pasien,
            'nik_pasien'   => $pasien->nik_pasien,
            'no_rm'        => $pasien->id_rekam_medis,
        ]);
}

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view(
            'pasien.show',
            compact('pasien')
        );
    }

    public function edit(Pasien $pasien)
    {
        return view(
            'pasien.edit',
            compact('pasien')
        );
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nik_pasien'      => 'required',
            'id_rekam_medis'  => 'required',
            'nama_pasien'     => 'required',
            'nama_kk'         => 'required',
            'jenis_kelamin'   => 'required',
            'tanggal_lahir'   => 'required',
            'kode_desa'       => 'required',
            'rt'              => 'required',
            'rw'              => 'required',
            'no_hp'           => 'required',
            'alamat_pasien'   => 'required',
            'id_bpjs'         => 'required',
        ]);

        $pasien->update([

            'nik_pasien'      => $request->nik_pasien,
            'nama_pasien'     => $request->nama_pasien,
            'nama_kk'         => $request->nama_kk,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'kode_desa'       => $request->kode_desa,
            'rt'              => $request->rt,
            'rw'              => $request->rw,
            'id_bpjs'         => $request->id_bpjs,
            'id_rekam_medis'  => $request->id_rekam_medis,
            'no_hp'           => $request->no_hp,
            'alamat_pasien'   => $request->alamat_pasien,

        ]);

        return redirect()
            ->route('pasien.index')
            ->with(
                'success',
                'Data pasien berhasil diupdate.'
            );
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()
            ->route('pasien.index')
            ->with(
                'success',
                'Data pasien berhasil dihapus.'
            );
    }
}