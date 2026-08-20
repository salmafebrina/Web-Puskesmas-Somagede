@extends('layouts.pembayaran')

@section('title', 'Dashboard Pembayaran')

@section('page-title', 'Dashboard Pembayaran')

@section('content')

<style>

    /* ==============================
       INTRO
    ============================== */

    .dashboard-intro {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 24px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        text-align: center;
    }

    .dashboard-intro h5 {
        margin: 0;
        color: #102347;
        font-size: 18px;
        font-weight: 600;
    }

    .dashboard-intro p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }


    /* ==============================
       STAT CARD
    ============================== */

    .payment-card {
        border: none;
        border-radius: 16px;
        height: 100%;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }

    .payment-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.13);
    }

    .payment-card .card-body {
        padding: 24px;
    }


    /* ==============================
       WARNA CARD
    ============================== */

    .card-menunggu {
        background: #fffbeb;
    }

    .card-transaksi {
        background: #eff6ff;
    }

    .card-pendapatan {
        background: #ecfdf5;
    }

    .card-selesai {
        background: #f5f3ff;
    }


    /* ==============================
       ICON
    ============================== */

    .payment-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 26px;
        margin-bottom: 15px;
    }

    .icon-menunggu {
        background: #fef3c7;
    }

    .icon-transaksi {
        background: #dbeafe;
    }

    .icon-pendapatan {
        background: #d1fae5;
    }

    .icon-selesai {
        background: #ede9fe;
    }


    /* ==============================
       TEXT
    ============================== */

    .payment-name {
        font-size: 16px;
        font-weight: 600;
        color: #102347;
        margin-bottom: 6px;
    }

    .payment-number {
        font-size: 34px;
        font-weight: 700;
        color: #102347;
        line-height: 1.2;
    }

    .payment-description {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 768px) {

        .payment-number {
            font-size: 30px;
        }

    }
    </style>
  
{{-- ==========================================
     INFORMASI
========================================== --}}

<div class="dashboard-intro">

    <h5>
        Ringkasan Pembayaran Hari Ini
    </h5>

    <p>
        Informasi transaksi dan pembayaran pasien pada hari ini.
    </p>

</div>


{{-- ==========================================
     STATISTIK PEMBAYARAN
========================================== --}}

<div class="row g-3">


    {{-- MENUNGGU PEMBAYARAN --}}
    <div class="col-xl-3 col-lg-6 col-md-6">

        <div class="card payment-card card-menunggu">

            <div class="card-body">

                <div class="payment-icon icon-menunggu">
                    🧾
                </div>

                <div class="payment-name">
                    Menunggu Pembayaran
                </div>

                <div class="payment-number">
                    {{ $menungguPembayaran }}
                </div>

                <div class="payment-description">
                    Pasien menunggu pembayaran
                </div>

            </div>

        </div>

    </div>


    {{-- TRANSAKSI HARI INI --}}
    <div class="col-xl-3 col-lg-6 col-md-6">

        <div class="card payment-card card-transaksi">

            <div class="card-body">

                <div class="payment-icon icon-transaksi">
                    💳
                </div>

                <div class="payment-name">
                    Transaksi Hari Ini
                </div>

                <div class="payment-number">
                    {{ $transaksiHariIni }}
                </div>

                <div class="payment-description">
                    Total transaksi hari ini
                </div>

            </div>

        </div>

    </div>


    {{-- PENDAPATAN --}}
    <div class="col-xl-3 col-lg-6 col-md-6">

        <div class="card payment-card card-pendapatan">

            <div class="card-body">

                <div class="payment-icon icon-pendapatan">
                    💰
                </div>

                <div class="payment-name">
                    Pendapatan Hari Ini
                </div>

                <div class="payment-number">
                    Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
                </div>

                <div class="payment-description">
                    Total pendapatan hari ini
                </div>

            </div>

        </div>

    </div>


    {{-- PEMBAYARAN SELESAI --}}
    <div class="col-xl-3 col-lg-6 col-md-6">

        <div class="card payment-card card-selesai">

            <div class="card-body">

                <div class="payment-icon icon-selesai">
                    ✓
                </div>

                <div class="payment-name">
                    Pembayaran Selesai
                </div>

                <div class="payment-number">
                    {{ $pembayaranSelesai }}
                </div>

                <div class="payment-description">
                    Pembayaran yang telah selesai
                </div>

            </div>

        </div>

    </div>


</div>

@endsection