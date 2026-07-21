<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    

public function index()
{
    $obats = Obat::all();

    return view('obat.index', compact('obats'));
}

    
    public function create()
{
    return view('obat.create');
}

   public function store(Request $request)
{
    $request->validate([
        'nama_obat' => 'required',
        'jenis_obat' => 'required',
        'kategori_obat' => 'required',
        'stok_obat' => 'required',
        'satuan_obat' => 'required',
        'stok_minimum' => 'required',
        'tanggal_expired' => 'required',
    ]);

    Obat::create($request->all());

    return redirect()->route('obat.index')
        ->with('success', 'Data obat berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
{
    return view('obat.edit', compact('obat'));
}

    public function update(Request $request, Obat $obat)
{
    $obat->update([
        'nama_obat' => $request->nama_obat,
        'jenis_obat' => $request->jenis_obat,
        'kategori_obat' => $request->kategori_obat,
        'stok_obat' => $request->stok_obat,
        'stok_minimum' => $request->stok_minimum,
        'satuan_obat' => $request->satuan_obat,
        'tanggal_expired' => $request->tanggal_expired,
    ]);

    return redirect()->route('obat.index')
        ->with('success', 'Data obat berhasil diperbarui');
}

   public function destroy(Obat $obat)
{
    $obat->delete();

    return redirect()->route('obat.index')
        ->with('success', 'Data obat berhasil dihapus');
}
}
