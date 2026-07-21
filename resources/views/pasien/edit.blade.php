@extends('layouts.pendaftaran')

@section('title', 'Edit Pasien')

@section('page-title', 'Edit Pasien')

@section('content')

<h3>Edit Pasien</h3>

<form action="{{ route('pasien.update', $pasien->id_pasien) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>No Rekam Medis</label>
    <input
    type="text"
    class="form-control"
    value="{{ $pasien->id_rekam_medis }}"
    readonly>
    </div>

    <div class="mb-3">
        <label>NIK</label>
        <input type="text"
               name="nik_pasien"
               value="{{ $pasien->nik_pasien }}"
               class="form-control">
    </div>
   
    <div class="mb-3">
        <label>Nama Pasien</label>
        <input type="text"
               name="nama_pasien"
               value="{{ $pasien->nama_pasien }}"
               class="form-control">
    </div>

   <div class="mb-3">
        <label>Nama KK</label>
        <input type="text"
               name="nama_kk"
               value="{{ $pasien->nama_kk }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>No BPJS</label>
            <input
        type="text"
        name="id_bpjs"
        class="form-control"
        value="{{ $pasien->id_bpjs }}">

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control">
            <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>

    <div class="mb-3">
    <label>Tanggal Lahir</label>
    <input type="date"
           name="tanggal_lahir"
           value="{{ $pasien->tanggal_lahir }}"
           class="form-control">
    </div>

    <div class="mb-3">
        <label>Kode Desa</label>
        <input type="text"
               name="kode_desa"
               value="{{ $pasien->kode_desa }}"
               class="form-control">
            </div>

    <div class="mb-3">
        <label>RT</label>
        <input
        type="text"
        name="rt"
        class="form-control"
        value="{{ $pasien->rt }}">
    </div>

    <div class="mb-3">
        <label>RW</label>
            <input
            type="text"
            name="rw"
            class="form-control"
            value="{{ $pasien->rw }}">
    </div>

    <div class="mb-3">
        <label>No HP</label>   
        <input type="text"
                name="no_hp"
                value="{{ $pasien->no_hp }}"
                class="form-control">
    </div>
    
    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat_pasien" class="form-control">{{ $pasien->alamat_pasien }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">
        Update
    </button>

</form>

@endsection