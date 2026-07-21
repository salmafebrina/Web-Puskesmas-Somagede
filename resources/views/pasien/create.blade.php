@extends('layouts.pendaftaran')

@section('title', 'Tambah Pasien')

@section('page-title', 'Tambah Pasien')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Tambah Data Pasien</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('pasien.store') }}" method="POST">

            @csrf
            
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif

            <input
                type="hidden"
                name="id_antrian"
                value="{{ $id_antrian }}">

            <div class="mb-3">
                <label>NIK</label>
                <input
                    type="text"
                    name="nik_pasien"
                    class="form-control"
                    value="{{ old('nik_pasien', $nik) }}"
                    readonly>
            </div>

            <div class="mb-3">
            <label>No Rekam Medis</label>

            <input
                type="text"
                name="id_rekam_medis"
                class="form-control"
                value="{{ $nomorRM }}"
                readonly>

</div>

            <div class="mb-3">
                <label>Nama Pasien</label>
                <input
                    type="text"
                    name="nama_pasien"
                    class="form-control"
                    value="{{ old('nama_pasien') }}">
            </div>

            <div class="mb-3">
                <label>Nama KK</label>
                <input
                    type="text"
                    name="nama_kk"
                    class="form-control"
                    value="{{ old('nama_kk') }}">
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>

                <input
                    type="date"
                    name="tanggal_lahir"
                    class="form-control"
                    value="{{ old('tanggal_lahir') }}">

            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" class="form-control">

                <option value="">-- Pilih Jenis Kelamin --</option>

                <option value="L"
                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                    Laki-laki
                </option>

                <option value="P"
                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                    Perempuan
                </option>

            </select>

            </div>

            <div class="mb-3">
            <label>No BPJS</label>
            <input
                type="text"
                name="id_bpjs"
                class="form-control"
                value="{{ old('id_bpjs') }}"
                placeholder="Kosongkan jika pasien tidak memiliki BPJS">

            </div>
             
            <div class="mb-3">
                <label>Desa</label>
            <select
                name="kode_desa"
                class="form-control">

                <option value="">-- Pilih Desa --</option>

                <option value="001">
                    Sokawera
                </option>

                <option value="002">
                    Somagede
                </option>

            </select>
            </div>

            <div class="row">
    <div class="col-md-6">

        <label>RT</label>

        <input
            type="text"
            name="rt"
            class="form-control"
            value="{{ old('rt') }}">

    </div>

    <div class="col-md-6">

        <label>RW</label>

        <input
            type="text"
            name="rw"
            class="form-control"
            value="{{ old('rw') }}">

    </div>

</div>

            <div class="mb-3">
                <label>No HP</label>

                <input
                    type="text"
                    name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp') }}">

            </div>

            <div class="mb-3">
                <label>Alamat</label>

                <textarea
                    name="alamat_pasien"
                    class="form-control"
                    rows="3">{{ old('alamat_pasien') }}</textarea>

            </div>

            <button
                type="submit"
                class="btn btn-success">

                Simpan Data Pasien

            </button>

            <a href="{{ route('pendaftaran.daftar.index') }}"
            class="btn btn-secondary">

            Batal

            </a>

        </form>

    </div>

</div>


@endsection

