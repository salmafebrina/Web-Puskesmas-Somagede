<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\ObatMasuk;
use Illuminate\Http\Request;

class ObatMasukController extends Controller
{
    public function index()
    {
        $obatMasuks = ObatMasuk::with('obat')
                        ->latest()
                        ->get();

        return view(
            'farmasi.ObatMasuk.index',
            compact('obatMasuks')
        );
    }

    public function create()
    {
        $obats = Obat::all();

        return view(
            'farmasi.ObatMasuk.create',
            compact('obats')
        );
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama_obat' => 'required',
        'tanggal_masuk' => 'required|date',
        'jumlah_masuk' => 'required|integer|min:1',
        'keterangan' => 'nullable'
    ]);

    // Simpan riwayat obat masuk
    ObatMasuk::create([
        'nama_obat' => $request->nama_obat,
        'tanggal_masuk' => $request->tanggal_masuk,
        'jumlah_masuk' => $request->jumlah_masuk,
        'keterangan' => $request->keterangan,
    ]);

    // Tambahkan stok obat
    $obat = Obat::findOrFail($request->id_obat);

    $obat->stok += $request->jumlah_masuk;

    $obat->save();

    return redirect()
        ->route('obat-masuk.index')
        ->with('success', 'Data obat masuk berhasil disimpan.');
    }

    public function edit($id)
    {
    $obatMasuk = ObatMasuk::findOrFail($id);

    $obats = Obat::all();

    return view(
        'farmasi.ObatMasuk.edit',
        compact('obatMasuk', 'obats')
    );
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'id_obat' => 'required',
        'tanggal_masuk' => 'required|date',
        'jumlah_masuk' => 'required|integer|min:1',
        'keterangan' => 'nullable'
    ]);

    $obatMasuk = ObatMasuk::findOrFail($id);

    $obat = Obat::findOrFail($obatMasuk->id_obat);

    // Kembalikan stok lama
    $obat->stok -= $obatMasuk->jumlah_masuk;

    // Tambahkan stok baru
    $obat->stok += $request->jumlah_masuk;

    $obat->save();

    // Update data
    $obatMasuk->update([
        'id_obat' => $request->id_obat,
        'tanggal_masuk' => $request->tanggal_masuk,
        'jumlah_masuk' => $request->jumlah_masuk,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()
        ->route('obat-masuk.index')
        ->with('success', 'Data obat masuk berhasil diperbarui.');
}

    public function destroy($id)
    {
    $obatMasuk = ObatMasuk::findOrFail($id);

    $obat = Obat::findOrFail($obatMasuk->id_obat);

    $obat->stok -= $obatMasuk->jumlah_masuk;

    $obat->save();

    $obatMasuk->delete();

    return redirect()
        ->route('obat-masuk.index')
        ->with('success', 'Data obat masuk berhasil dihapus.');
    }
}