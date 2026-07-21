@extends('layouts.app')

@section('title', 'Edit Obat')

@section('page-title', 'Edit Obat')

@section('content')

<form action="{{ route('obat.update', $obat->id_obat) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Obat</label>
        <input type="text"
               name="nama_obat"
               value="{{ $obat->nama_obat }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Jenis Obat</label>
        <input type="text"
               name="jenis_obat"
               value="{{ $obat->jenis_obat }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Kategori Obat</label>
        <input type="text"
               name="kategori_obat"
               value="{{ $obat->kategori_obat }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stok Obat</label>
        <input type="number"
               name="stok_obat"
               value="{{ $obat->stok_obat }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stok Minimum</label>
        <input type="number"
               name="stok_minimum"
               value="{{ $obat->stok_minimum }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Satuan Obat</label>
        <input type="text"
               name="satuan_obat"
               value="{{ $obat->satuan_obat }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Tanggal Expired</label>
        <input type="date"
               name="tanggal_expired"
               value="{{ $obat->tanggal_expired }}"
               class="form-control">
    </div>

    <button type="submit" class="btn btn-success">
        Update
    </button>

</form>

@endsection