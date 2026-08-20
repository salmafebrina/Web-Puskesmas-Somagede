@extends('layouts.farmasi')

@section('title', 'Dashboard Obat')

@section('page-title', 'Dashboard Obat')

@section('content')

<style>

    /* ==============================
       DASHBOARD CARD
    ============================== */

    .dashboard-card {
        border: none;
        border-radius: 14px;
        height: 100%;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 18px rgba(0,0,0,0.11);
    }

    .dashboard-card .card-body {
        padding: 22px;
    }


    /* ==============================
       CARD WARNA
    ============================== */

    .card-resep {
        background: #eff6ff;
    }

    .card-obat {
        background: #f0fdf4;
    }

    .card-pasien {
        background: #f5f3ff;
    }


    /* ==============================
       ICON
    ============================== */

    .dashboard-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 24px;
        margin-bottom: 14px;
    }

    .icon-resep {
        background: #dbeafe;
    }

    .icon-obat {
        background: #dcfce7;
    }

    .icon-pasien {
        background: #ede9fe;
    }


    /* ==============================
       TEXT
    ============================== */

    .dashboard-label {
        font-size: 15px;
        font-weight: 600;
        color: #102347;
        margin-bottom: 5px;
    }

    .dashboard-number {
        font-size: 34px;
        font-weight: 700;
        color: #102347;
        line-height: 1.2;
    }

    .dashboard-description {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }


    /* ==============================
       STOK MENIPIS
    ============================== */

    .stok-card {
        border: none;
        border-radius: 14px;
        background: #fffbeb;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-top: 24px;
    }

    .stok-header {
        background: #fef3c7;
        padding: 16px 20px;
        color: #92400e;
        font-weight: 600;
        font-size: 16px;
    }

    .stok-body {
        padding: 0;
    }

    .stok-table {
        margin: 0;
    }

    .stok-table th {
        background: #fffbeb;
        color: #92400e;
        font-size: 13px;
        font-weight: 600;
        padding: 13px 16px;
    }

    .stok-table td {
        padding: 13px 16px;
        font-size: 13px;
        vertical-align: middle;
    }

    .badge-menipis {
        background: #fef3c7;
        color: #92400e;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .stok-kosong {
        padding: 25px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
    }

</style>


{{-- ==========================================
     RINGKASAN DASHBOARD
========================================== --}}

<div class="row g-3">


    {{-- RESEP MENUNGGU --}}
    <div class="col-xl-4 col-md-6">

        <div class="card dashboard-card card-resep">

            <div class="card-body">

                <div class="dashboard-icon icon-resep">
                    💊
                </div>

                <div class="dashboard-label">
                    Resep Menunggu
                </div>

                <div class="dashboard-number">
                    {{ $resepMenunggu }}
                </div>

                <div class="dashboard-description">
                    Resep menunggu penyiapan
                </div>

            </div>

        </div>

    </div>


    {{-- OBAT KELUAR --}}
    <div class="col-xl-4 col-md-6">

        <div class="card dashboard-card card-obat">

            <div class="card-body">

                <div class="dashboard-icon icon-obat">
                    💊
                </div>

                <div class="dashboard-label">
                    Obat Keluar Hari Ini
                </div>

                <div class="dashboard-number">
                    0
                </div>

                <div class="dashboard-description">
                    Jumlah obat yang diserahkan
                </div>

            </div>

        </div>

    </div>


    {{-- PASIEN SELESAI --}}
    <div class="col-xl-4 col-md-6">

        <div class="card dashboard-card card-pasien">

            <div class="card-body">

                <div class="dashboard-icon icon-pasien">
                    👥
                </div>

                <div class="dashboard-label">
                    Pasien Selesai
                </div>

                <div class="dashboard-number">
                    {{ $pasienSelesai }}
                </div>

                <div class="dashboard-description">
                    Pasien selesai pelayanan hari ini
                </div>

            </div>

        </div>

    </div>

</div>


{{-- ==========================================
     STOK OBAT MENIPIS
========================================== --}}

<div class="card stok-card">

    <div class="stok-header">
        ⚠️ Stok Obat Menipis
    </div>


    <div class="stok-body">

        @if($stokMenipis->count() > 0)

            <div class="table-responsive">

                <table class="table stok-table">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Stok Saat Ini</th>
                            <th>Stok Minimum</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($stokMenipis as $index => $obat)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $obat->nama_obat }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $obat->stok_obat }}
                                    {{ $obat->satuan_obat }}
                                </td>

                                <td>
                                    {{ $obat->stok_minimum }}
                                    {{ $obat->satuan_obat }}
                                </td>

                                <td>
                                    <span class="badge-menipis">
                                        Stok Menipis
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="stok-kosong">

                ✅ Tidak ada obat dengan stok menipis.

            </div>

        @endif

    </div>

</div>


@endsection