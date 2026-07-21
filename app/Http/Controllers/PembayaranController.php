<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('pembayaran.riwayat.index');
    }

    public function transaksi()
    {
        return view('pembayaran.transaksi.index');
    }

    public function riwayat()
    {
        return view('pembayaran.riwayat.index');
    }
}