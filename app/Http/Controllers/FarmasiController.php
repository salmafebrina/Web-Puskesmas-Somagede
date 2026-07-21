<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmasiController extends Controller
{
    public function farmasi()
    {
        return view('farmasi');
    }

    public function penyerahan()
    {
        return view('farmasi.ObatKeluar.index');
    }

    public function create($id)
    {
        return view('farmasi.ObatKeluar.create');
    }

    public function store(Request $request)
    {

    }

    public function obatKeluar()
    {
        return view('farmasi.ObatKeluar.index');
    }

    public function riwayat()
    {
        return view('farmasi.riwayat.index');
    }
}