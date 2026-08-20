@extends('layouts.pemeriksaan')

@section('title', 'Dashboard Pemeriksaan')

@section('page-title', 'Dashboard Pemeriksaan')

@section('content')

<style>

    /* =========================
       POLI CARD
    ========================= */

    .poli-card {
        border: none;
        border-radius: 14px;
        background: #ffffff;
        box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
        height: 100%;
        overflow: hidden;
    }

    .poli-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 7px 20px rgba(0,0,0,0.12);
    }

    .poli-card .card-body {
        padding: 24px;
    }


    /* =========================
       ICON
    ========================= */

    .poli-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 25px;

        margin-bottom: 15px;
    }

    .icon-umum {
        background: #dbeafe;
    }

    .icon-gigi {
        background: #e0e7ff;
    }

    .icon-kia {
        background: #fce7f3;
    }

    .icon-kb {
        background: #fef3c7;
    }

    .icon-gizi {
        background: #dcfce7;
    }

    .icon-sanitarian {
        background: #d1fae5;
    }

    .icon-mtbs {
        background: #ede9fe;
    }


    /* =========================
       TEXT
    ========================= */

    .poli-name {
        font-size: 16px;
        font-weight: 600;
        color: #102347;
        margin-bottom: 5px;
    }

    .poli-number {
        font-size: 36px;
        font-weight: 700;
        color: #102347;
        line-height: 1.2;
    }

    .poli-description {
        font-size: 12px;
        color: #7a7a7a;
        margin-top: 5px;
    }


    /* =========================
       HEADER
    ========================= */

   /* =========================
   HEADER DAFTAR PASIEN
========================= */

.dashboard-intro {
    background: linear-gradient(135deg, #e8f1ff, #f5f9ff);
    border-radius: 14px;
    padding: 22px 24px;
    margin-bottom: 22px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);

    /* Membuat isi berada di tengah */
    text-align: center;

    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-intro h5 {
    margin: 0;
    color: #102347;
    font-weight: 700;
    font-size: 20px;
}

    /* =========================
       SECTION TITLE
    ========================= */

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #102347;
        margin-bottom: 15px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .poli-number {
            font-size: 30px;
        }

    }

</style>


{{-- ==========================================
     INFORMASI DASHBOARD
========================================== --}}

<div class="dashboard-intro">

    <h5>
        Daftar Pasien Menunggu 
    </h5>

</div>


{{-- ==========================================
     DAFTAR POLI
========================================== --}}

<div class="row g-3">


    {{-- POLI UMUM --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-umum">
                    🩺
                </div>

                <div class="poli-name">
                    Poli Umum
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliUmum }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


    {{-- POLI GIGI --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-gigi">
                    🦷
                </div>

                <div class="poli-name">
                    Poli Gigi
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliGigi }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


    {{-- POLI KIA --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-kia">
                    👩‍⚕️
                </div>

                <div class="poli-name">
                    Poli KIA
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliKia }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


    {{-- POLI KB --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-kb">
                    👶
                </div>

                <div class="poli-name">
                    Poli KB
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliKb }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


    {{-- POLI GIZI --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-gizi">
                    🥗
                </div>

                <div class="poli-name">
                    Poli Gizi
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliGizi }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


    {{-- POLI SANITARIAN --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-sanitarian">
                    🌱
                </div>

                <div class="poli-name">
                    Poli Sanitarian
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliSanitarian }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


    {{-- POLI MTBS --}}
    <div class="col-xl-3 col-lg-4 col-md-6">

        <div class="card poli-card">

            <div class="card-body">

                <div class="poli-icon icon-mtbs">
                    👶
                </div>

                <div class="poli-name">
                    Poli MTBS
                </div>

                <div class="poli-number">
                    {{ $jumlahPoliMtbs }}
                </div>

                <div class="poli-description">
                    Pasien menunggu pemeriksaan
                </div>

            </div>

        </div>

    </div>


</div>

@endsection