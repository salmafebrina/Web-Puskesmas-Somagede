@extends('layouts.pendaftaran')

@section('title', 'Dashboard Pendaftaran')

@section('page-title', 'Dashboard Pendaftaran')

@section('content')

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Total Antrian Hari Ini</h6>
                <h3>25</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Pasien Baru</h6>
                <h3>5</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Kunjungan Hari Ini</h6>
                <h3>20</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Menunggu Pemeriksaan</h6>
                <h3>12</h3>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body text-center">

                <h5>Cetak Antrian</h5>

                <p>
                    Buat nomor antrian pasien
                    berdasarkan poli tujuan.
                </p>

                <a href="#" class="btn btn-primary">
                    Buka
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body text-center">

                <h5>Daftar Kunjungan</h5>

                <p>
                    Registrasi kunjungan pasien
                    baru maupun lama.
                </p>

                <a href="#" class="btn btn-success">
                    Buka
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body text-center">

                <h5>Riwayat Pendaftaran</h5>

                <p>
                    Melihat seluruh data
                    kunjungan pasien.
                </p>

                <a href="#" class="btn btn-secondary">
                    Buka
                </a>

            </div>
        </div>
    </div>

</div>

@endsection