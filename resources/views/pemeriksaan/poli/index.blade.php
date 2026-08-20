@extends('layouts.pemeriksaan')

@section('title', 'Pemeriksaan Poli')

@section('page-title', 'Pemeriksaan Poli')

@section('content')

<style>

    /* ==============================
       INFORMASI
    ============================== */

    .dashboard-intro {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 24px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        text-align: center;
    }

    .dashboard-intro p {
        margin: 0;
        color: #5f6b7a;
        font-size: 15px;
    }


    /* ==============================
       POLI CARD
    ============================== */

    .poli-card {
        border: none;
        border-radius: 16px;
        height: 100%;
        overflow: hidden;

        box-shadow: 0 4px 14px rgba(0,0,0,0.08);

        transition: all 0.2s ease;
    }

    .poli-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.13);
    }

    .poli-card .card-body {
        padding: 25px;
        text-align: center;
    }


    /* ==============================
       WARNA CARD
    ============================== */

    .card-umum {
        background: #eff6ff;
    }

    .card-gigi {
        background: #eef2ff;
    }

    .card-kia {
        background: #fdf2f8;
    }

    .card-kb {
        background: #fffbeb;
    }

    .card-gizi {
        background: #f0fdf4;
    }

    .card-sanitarian {
        background: #ecfdf5;
    }

    .card-mtbs {
        background: #f5f3ff;
    }


    /* ==============================
       ICON
    ============================== */

    .poli-icon {
        width: 60px;
        height: 60px;

        margin: 0 auto 15px;

        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 30px;
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


    /* ==============================
       TEXT
    ============================== */

    .poli-name {
        font-size: 17px;
        font-weight: 600;

        color: #102347;

        margin-bottom: 8px;
    }

    .poli-number {
        font-size: 38px;
        font-weight: 700;

        line-height: 1.2;

        color: #102347;
    }

    .poli-description {
        font-size: 13px;

        color: #6b7280;

        margin-top: 6px;
        margin-bottom: 18px;
    }


    /* ==============================
       BUTTON
    ============================== */

    .btn-masuk {
        padding: 8px 18px;
        border-radius: 7px;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 768px) {

        .poli-number {
            font-size: 32px;
        }

        .poli-card .card-body {
            padding: 20px;
        }

    }

</style>


{{-- ==========================================
     INFORMASI
========================================== --}}

<div class="dashboard-intro">

    <p>
        Silakan pilih poli untuk melihat daftar pasien
        yang menunggu pemeriksaan poli.
    </p>

</div>


{{-- ==========================================
     DAFTAR POLI
========================================== --}}

<div class="row g-3">

    @foreach($polis as $poli)

        @php

            $nama = $poli->poli_tujuan;

            $classCard = match($nama) {

                'Poli Umum' => 'card-umum',
                'Poli Gigi' => 'card-gigi',
                'Poli KIA' => 'card-kia',
                'Poli KB' => 'card-kb',
                'Poli Gizi' => 'card-gizi',
                'Poli Sanitarian' => 'card-sanitarian',
                'Poli MTBS' => 'card-mtbs',

                default => 'card-umum'

            };


            $classIcon = match($nama) {

                'Poli Umum' => 'icon-umum',
                'Poli Gigi' => 'icon-gigi',
                'Poli KIA' => 'icon-kia',
                'Poli KB' => 'icon-kb',
                'Poli Gizi' => 'icon-gizi',
                'Poli Sanitarian' => 'icon-sanitarian',
                'Poli MTBS' => 'icon-mtbs',

                default => 'icon-umum'

            };


            $icon = match($nama) {

                'Poli Umum' => '🩺',
                'Poli Gigi' => '🦷',
                'Poli KIA' => '👩‍⚕️',
                'Poli KB' => '👶',
                'Poli Gizi' => '🥗',
                'Poli Sanitarian' => '🌱',
                'Poli MTBS' => '👶',

                default => '🏥'

            };

        @endphp


        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card poli-card {{ $classCard }}">

                <div class="card-body">


                    {{-- ICON --}}

                    <div class="poli-icon {{ $classIcon }}">

                        {{ $icon }}

                    </div>


                    {{-- NAMA POLI --}}

                    <div class="poli-name">

                        {{ $nama }}

                    </div>


                    {{-- JUMLAH PASIEN --}}

                    <div class="poli-number">

                        {{ $poli->jumlah_pasien }}

                    </div>


                    <div class="poli-description">

                        Pasien menunggu pemeriksaan

                    </div>


                    {{-- BUTTON --}}

                    <a href="{{ route(
                        'pemeriksaan.poli.daftar',
                        ['namaPoli' => $nama]
                    ) }}"
                       class="btn btn-primary btn-masuk">

                        Masuk
                        <span class="ms-1">→</span>

                    </a>


                </div>

            </div>

        </div>

    @endforeach

</div>

@endsection