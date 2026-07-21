@extends('layouts.pendaftaran')

@section('title','Edit Pendaftaran')

@section('page-title','Edit Pendaftaran')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Edit Data Pendaftaran</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('kunjungan.update',$kunjungan->id_kunjungan) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>No Rekam Medis</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $kunjungan->no_rekam_medis }}"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Pasien</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $kunjungan->nama_pasien }}"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenis Jaminan</label>

                    <select
                        name="jenis_jaminan"
                        class="form-control">

                        <option
                            value="BPJS"
                            {{ $kunjungan->jenis_jaminan=='BPJS' ? 'selected' : '' }}>
                            BPJS
                        </option>

                        <option
                            value="Umum"
                            {{ $kunjungan->jenis_jaminan=='Umum' ? 'selected' : '' }}>
                            Umum
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">
                    <label>No BPJS</label>

                    <input
                        type="text"
                        name="no_bpjs"
                        class="form-control"
                        value="{{ $kunjungan->no_bpjs }}">
                </div>

                <div class="col-md-6 mb-3">

                    <label>Poli Tujuan</label>

                    <select
                        name="poli_tujuan"
                        class="form-control">

                        <option {{ $kunjungan->poli_tujuan=='Poli Umum' ? 'selected' : '' }}>
                            Poli Umum
                        </option>

                        <option {{ $kunjungan->poli_tujuan=='Poli Gigi' ? 'selected' : '' }}>
                            Poli Gigi
                        </option>

                        <option {{ $kunjungan->poli_tujuan=='Poli KIA' ? 'selected' : '' }}>
                            Poli KIA
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Surat Keterangan</label>

                    <select
                        name="surat_keterangan"
                        class="form-control">

                        <option {{ $kunjungan->surat_keterangan=='Tidak Ada' ? 'selected' : '' }}>
                            Tidak Ada
                        </option>

                        <option {{ $kunjungan->surat_keterangan=='SKD' ? 'selected' : '' }}>
                            SKD
                        </option>

                        <option {{ $kunjungan->surat_keterangan=='Capeng' ? 'selected' : '' }}>
                            Capeng
                        </option>

                        <option {{ $kunjungan->surat_keterangan=='Lainnya' ? 'selected' : '' }}>
                            Lainnya
                        </option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">
                    <label>RT</label>

                    <input
                        type="text"
                        name="rt"
                        class="form-control"
                        value="{{ $kunjungan->rt }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>RW</label>

                    <input
                        type="text"
                        name="rw"
                        class="form-control"
                        value="{{ $kunjungan->rw }}">
                </div>

            </div>

            <button
                class="btn btn-success">

                Simpan Perubahan

            </button>

            <a href="{{ route('pendaftaran.riwayat.index') }}"
                class="btn btn-secondary">

                Batal

            </a>

        </form>

    </div>

</div>

@endsection