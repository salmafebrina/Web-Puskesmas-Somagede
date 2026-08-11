@extends('layouts.pembayaran')

@section('title', 'Dashboard Pembayaran')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">Dashboard Pembayaran</h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Menunggu Pembayaran</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Transaksi Hari Ini</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection