@extends('layouts.pemeriksaan')

@section('title','Pemeriksaan Awal')

@section('page-title','Pemeriksaan Awal')

@section('content')

<div class="card mb-4">

    <div class="card-header bg-primary text-white">

        <h5>Identitas Pasien</h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>No Rekam Medis</label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->no_rekam_medis }}"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>Nama Pasien</label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->nama_pasien }}"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>NIK</label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->nik_pasien }}"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>Poli</label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->poli_tujuan }}"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>Jenis Jaminan</label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->jenis_jaminan }}"
                    readonly>

            </div>

        </div>

    </div>

</div>


<div class="card">

    <div class="card-header bg-success text-white">

        <h5>Form Pemeriksaan Awal</h5>

    </div>

    <div class="card-body">

        <form
            action="{{ route('pemeriksaan.awal.store') }}"
            method="POST">

            @csrf

            <input
                type="hidden"
                name="id_kunjungan"
                value="{{ $kunjungan->id_kunjungan }}">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Berat Badan (Kg)</label>

                    <input
                        type="number"
                        step="0.1"
                        name="berat_badan"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Tinggi Badan (Cm)</label>

                    <input
                        type="number"
                        name="tinggi_badan"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Lingkar Perut (Cm)</label>

                    <input
                        type="number"
                        name="lingkar_perut"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Tekanan Darah</label>

                    <input
                        type="text"
                        name="tekanan_darah"
                        class="form-control"
                        placeholder="120/80">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Suhu Tubuh</label>

                    <input
                        type="number"
                        step="0.1"
                        name="suhu"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Nadi</label>

                    <input
                        type="number"
                        name="nadi"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Respirasi</label>

                    <input
                        type="number"
                        name="respirasi"
                        class="form-control">

                </div>

                <div class="col-12 mb-3">

                    <label>Keluhan Utama</label>

                    <textarea
                        name="keluhan"
                        rows="4"
                        class="form-control"></textarea>

                </div>

            </div>

            <a
                href="{{ route('pemeriksaan.awal.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

            <button
                class="btn btn-success">

                Simpan Pemeriksaan

            </button>

        </form>

    </div>

</div>

@endsection