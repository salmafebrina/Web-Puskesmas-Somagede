@extends('layouts.pendaftaran')

@section('title', 'Dashboard Pendaftaran')

@section('page-title', 'Dashboard Pendaftaran')

@section('content')

<style>

    /* =========================
       STATISTIC CARD
    ========================= */

    .stat-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .stat-card .card-body {
        padding: 22px;
    }

    .stat-label {
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 34px;
        font-weight: 700;
        color: #102347;
        margin: 0;
    }

    .stat-description {
        font-size: 12px;
        color: #8a8a8a;
        margin-top: 4px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        margin-bottom: 15px;
    }

    .icon-prioritas {
        background: #fff3cd;
    }

    .icon-reguler {
        background: #dbeafe;
    }

    .icon-pasien {
        background: #d1fae5;
    }

    .icon-baru {
        background: #fee2e2;
    }


    /* =========================
       QUICK ACCESS
    ========================= */

    .quick-card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        background: #ffffff;
        height: 100%;
        transition: all 0.2s ease;
    }

    .quick-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .quick-card .card-body {
        padding: 25px;
    }

    .quick-icon {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .quick-card h5 {
        font-weight: 600;
        color: #102347;
        margin-bottom: 8px;
    }

    .quick-card p {
        color: #6c757d;
        font-size: 14px;
        min-height: 42px;
    }

    .dashboard-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #102347;
        margin-bottom: 15px;
    }

    .btn-dashboard {
        min-width: 100px;
        border-radius: 7px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 992px) {

        .stat-number {
            font-size: 30px;
        }

    }

    @media (max-width: 768px) {

        .stat-card {
            margin-bottom: 15px;
        }

        .quick-card {
            margin-bottom: 15px;
        }

    }

</style>


{{-- =========================================================
     STATISTIK PENDAFTARAN
========================================================= --}}

<div class="row g-3 mb-4">

    {{-- ANTRIAN PRIORITAS --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card">

            <div class="card-body">

                <div class="stat-icon icon-prioritas">
                    📌
                </div>

                <div class="stat-label">
                    Antrian Prioritas
                </div>

                <h2 class="stat-number">
                    {{ $jumlahPrioritas }}
                </h2>

                <div class="stat-description">
                    Antrian menunggu hari ini
                </div>

            </div>

        </div>

    </div>


    {{-- ANTRIAN REGULER --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card">

            <div class="card-body">

                <div class="stat-icon icon-reguler">
                    🎫
                </div>

                <div class="stat-label">
                    Antrian Reguler
                </div>

                <h2 class="stat-number">
                    {{ $jumlahReguler }}
                </h2>

                <div class="stat-description">
                    Antrian menunggu hari ini
                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL PASIEN --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card">

            <div class="card-body">

                <div class="stat-icon icon-pasien">
                    👥
                </div>

                <h6>Pasien Berkunjung Hari Ini</h6>

                <h3>{{ $pasienBerkunjungHariIni }}</h3>

                <small>Total kunjungan pasien hari ini</small>

            </div>

        </div>

    </div>


    {{-- PASIEN BARU --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card">

            <div class="card-body">

                <div class="stat-icon icon-baru">
                    🆕
                </div>

                <div class="stat-label">
                    Pasien Baru Hari Ini
                </div>

                <h2 class="stat-number">
                    {{ $pasienBaru }}
                </h2>

                <div class="stat-description">
                    Pasien yang baru terdaftar
                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     AKSES CEPAT
========================================================= --}}

<div class="dashboard-section-title">
    Akses Cepat
</div>


<div class="row g-3">

    {{-- CETAK ANTRIAN --}}
    <div class="col-lg-4 col-md-6">

        <div class="card quick-card">

            <div class="card-body text-center">

                <div class="quick-icon">
                    🎫
                </div>

                <h5>
                    Cetak Antrian
                </h5>

                <p>
                    Buat nomor antrian pasien
                    berdasarkan poli tujuan.
                </p>

                <a
                    href="/antrian"
                    class="btn btn-primary btn-dashboard">

                    Buka

                </a>

            </div>

        </div>

    </div>


    {{-- DAFTAR KUNJUNGAN --}}
    <div class="col-lg-4 col-md-6">

        <div class="card quick-card">

            <div class="card-body text-center">

                <div class="quick-icon">
                    📝
                </div>

                <h5>
                    Daftar Kunjungan
                </h5>

                <p>
                    Registrasi kunjungan pasien
                    baru maupun pasien lama.
                </p>

                <a
                    href="/daftar"
                    class="btn btn-success btn-dashboard">

                    Buka

                </a>

            </div>

        </div>

    </div>


    {{-- RIWAYAT PENDAFTARAN --}}
    <div class="col-lg-4 col-md-6">

        <div class="card quick-card">

            <div class="card-body text-center">

                <div class="quick-icon">
                    📋
                </div>

                <h5>
                    Riwayat Pendaftaran
                </h5>

                <p>
                    Melihat data kunjungan pasien
                    berdasarkan tanggal.
                </p>

                <a
                    href="/pendaftaran/riwayat"
                    class="btn btn-secondary btn-dashboard">

                    Buka

                </a>

            </div>

        </div>

    </div>

</div>


@endsection