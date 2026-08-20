<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatMasukController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $obats = Obat::query()
        ->when($search, function ($query) use ($search) {
            $query->where('nama_obat', 'like', '%' . $search . '%')
                  ->orWhere('kategori_obat', 'like', '%' . $search . '%');
        })
        ->latest()
        ->get();

    return view(
        'Farmasi.ObatMasuk.index',
        compact('obats', 'search')
    );
}
    public function create()
    {
        return view('farmasi.obatMasuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat'       => 'required',
            'jenis_obat'      => 'required',
            'kategori_obat'   => 'required',
            'stok_obat'       => 'required|numeric',
            'stok_minimum'    => 'required|numeric',
            'satuan_obat'     => 'required',
            'tanggal_expired' => 'required|date',
        ]);

        Obat::create([
            'nama_obat'       => $request->nama_obat,
            'jenis_obat'      => $request->jenis_obat,
            'kategori_obat'   => $request->kategori_obat,
            'stok_obat'       => $request->stok_obat,
            'stok_minimum'    => $request->stok_minimum,
            'satuan_obat'     => $request->satuan_obat,
            'tanggal_expired' => $request->tanggal_expired,
        ]);

        return redirect()
            ->route('obat-masuk.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        return view(
            'farmasi.obat-masuk.edit',
            compact('obat')
        );
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat'       => 'required',
            'jenis_obat'      => 'required',
            'kategori_obat'   => 'required',
            'stok_obat'       => 'required|numeric',
            'stok_minimum'    => 'required|numeric',
            'satuan_obat'     => 'required',
            'tanggal_expired' => 'required|date',
        ]);

        $obat->update([
            'nama_obat'       => $request->nama_obat,
            'jenis_obat'      => $request->jenis_obat,
            'kategori_obat'   => $request->kategori_obat,
            'stok_obat'       => $request->stok_obat,
            'stok_minimum'    => $request->stok_minimum,
            'satuan_obat'     => $request->satuan_obat,
            'tanggal_expired' => $request->tanggal_expired,
        ]);

        return redirect()
            ->route('obat-masuk.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()
            ->route('obat-masuk.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}