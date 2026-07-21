<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();

        return view(
            'pembayaran.tarif.index',
            compact('tarifs')
        );
    }

    public function create()
    {
        return view('pembayaran.tarif.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }
};