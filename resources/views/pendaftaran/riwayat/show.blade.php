@extends('layouts.pendaftaran')

@section('title','Detail Pendaftaran')

@section('page-title','Detail Pendaftaran')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Detail Pendaftaran Pasien</h4>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>No Rekam Medis</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->no_rekam_medis }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>NIK</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->nik_pasien }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nama Pasien</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->nama_pasien }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nama KK</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->nama_kk }}" readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label>Usia</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->usia }} Tahun" readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label>Jenis Kelamin</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->jenis_kelamin }}" readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label>Status Pasien</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->status_pasien }}" readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label>Jenis Jaminan</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->jenis_jaminan }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>No BPJS</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->no_bpjs }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>Poli Tujuan</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->poli_tujuan }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>Surat Keterangan</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->surat_keterangan }}" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>Desa</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->desa }}" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>RT</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->rt }}" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>RW</label>
                <input type="text" class="form-control"
                    value="{{ $kunjungan->rw }}" readonly>
            </div>

            <div class="col-md-12 mb-3">
                <label>Status Kunjungan</label>

                @if($kunjungan->status_kunjungan == 'Menunggu Pemeriksaan Awal')

                    <span class="badge bg-warning fs-6">
                        {{ $kunjungan->status_kunjungan }}
                    </span>

                @elseif($kunjungan->status_kunjungan == 'Menunggu Pemeriksaan Poli')

                    <span class="badge bg-info fs-6">
                        {{ $kunjungan->status_kunjungan }}
                    </span>

                @elseif($kunjungan->status_kunjungan == 'Menunggu Pembayaran')

                    <span class="badge bg-primary fs-6">
                        {{ $kunjungan->status_kunjungan }}
                    </span>

                @else

                    <span class="badge bg-success fs-6">
                        {{ $kunjungan->status_kunjungan }}
                    </span>

                @endif

            </div>

        </div>

        <a href="{{ route('pendaftaran.riwayat.index') }}"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

@endsection