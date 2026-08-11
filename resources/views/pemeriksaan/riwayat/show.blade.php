@extends('layouts.pemeriksaan')

@section('title','Detail Riwayat Pemeriksaan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">
                <i class="bi bi-file-earmark-medical-fill text-primary"></i>
                Detail Rekam Medis
            </h3>
            <p class="text-muted">
                Riwayat hasil pemeriksaan pasien
            </p>
        </div>

        <a href="{{ route('pemeriksaan.riwayat.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>


<div class="card shadow-sm mb-4">

    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            Informasi Pasien
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Nama Pasien</label>

                <input
                    class="form-control"
                    value="{{ $kunjungan->pasien->nama_pasien }}"
                    readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label>Umur</label>

                <input
                    class="form-control"
                    value="{{ $kunjungan->usia }}"
                    readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label>Poli</label>

                <input
                    class="form-control"
                    value="{{ $kunjungan->poli_tujuan }}"
                    readonly>
            </div>

            <div class="col-12">

                <label>Alamat</label>

                <textarea
                    class="form-control"
                    readonly>{{ $kunjungan->pasien->alamat_pasien }}</textarea>

            </div>

        </div>

    </div>

</div>


<div class="card shadow-sm mb-4">

    <div class="card-header bg-warning">

        <h5 class="mb-0">
            Pemeriksaan Dokter
        </h5>

    </div>

    <div class="card-body">

        <label>Objective</label>

        <textarea
            class="form-control mb-3"
            rows="4"
            readonly>{{ $kunjungan->pemeriksaan->objektif }}</textarea>

        <label>Assessment</label>

        <textarea
            class="form-control"
            rows="4"
            readonly>{{ $kunjungan->pemeriksaan->assessment }}</textarea>

    </div>

</div>
<div class="card shadow-sm mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            Diagnosa

        </h5>

    </div>

    <div class="card-body">

        <div class="mb-3">

            <label>Kode ICD-10</label>

            <input
                class="form-control"
                value="{{ $kunjungan->pemeriksaan->kode_icd10 }}"
                readonly>

        </div>

        <div>

            <label>Diagnosa</label>

            <textarea
                class="form-control"
                rows="3"
                readonly>{{ $kunjungan->pemeriksaan->diagnosa }}</textarea>

        </div>

    </div>

</div>
<div class="card shadow-sm mb-4">

    <div class="card-header">

        <h5 class="mb-0">

            Tindakan

        </h5>

    </div>

    <div class="card-body">

        <textarea
            class="form-control"
            rows="3"
            readonly>{{ $kunjungan->pemeriksaan->tindakan }}</textarea>

    </div>

</div>
<div class="card shadow-sm mb-4">

    <div class="card-header">

        <h5 class="mb-0">

            Edukasi (KIE)

        </h5>

    </div>

    <div class="card-body">

        <textarea
            class="form-control"
            rows="4"
            readonly>{{ $kunjungan->pemeriksaan->kie }}</textarea>

    </div>

</div>
        <div class="card shadow-sm mb-5">

            <div class="card-header bg-info text-white">

                <h5 class="mb-0">

                    Tindak Lanjut

                </h5>

            </div>
            <div class="card shadow-sm mb-3">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    💊 Resep Obat

                </h5>

            </div>

            <div class="card-body">

                @if($kunjungan->resep)

                    <p>
                        Resep telah dibuat.
                    </p>

                    <a
                        href="{{ route('resep.show',$kunjungan->resep->id_resep) }}"
                        class="btn btn-success">

                        Detail Resep

                    </a>

                @else

                    <p class="text-muted">

                        Tidak ada resep.

                    </p>

                @endif

            </div>

        </div>
        <div class="card shadow-sm mb-3">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            💊 Check Laboratorium

        </h5>

    </div>

    <div class="card-body">

        @if($kunjungan->laboratorium)

            <p>
                surat telah dibuat.
            </p>

            <a
                href="{{ route('resep.show',$kunjungan->laboratorium->id_laboratorium) }}"
                class="btn btn-success">

                Detail Surat

            </a>

        @else

            <p class="text-muted">

                Tidak ada surat.

            </p>

        @endif

    </div>
    <div class="card shadow-sm mb-3">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            💊 Surat Rujukan

        </h5>

    </div>

    <div class="card-body">

        @if($kunjungan->rujukan)

            <p>
                Rujukan telah dibuat.
            </p>

            <a
                href="{{ route('resep.show',$kunjungan->rujukan->id_rujukan) }}"
                class="btn btn-success">

                Detail Rujukan

            </a>

        @else

            <p class="text-muted">

                Tidak ada rujukan.

            </p>

        @endif

    </div>

</div>




@endsection