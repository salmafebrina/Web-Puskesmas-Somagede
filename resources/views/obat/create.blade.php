@extends('layouts.app')

@section('title', 'Tambah Obat')

@section('page-title', 'Tambah Obat')

@section('content')

<form action="{{ route('obat.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nama_obat" class="form-label">Nama Obat</label>
        <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
    </div>

    <div class="mb-3">
        <label for="jenis_obat" class="form-label">Jenis Obat</label>
        <input type="text" class="form-control" id="jenis_obat" name="jenis_obat" required>
    </div> 
    <div class="mb-3">
        <label for="kategori_obat" class="form-label">Kategori Obat</label>
        <input type="text" class="form-control" id="kategori_obat" name="kategori_obat" required>
    </div>
    <div class="mb-3">
        <label for="stok_obat" class="form-label">Stok Obat</label>
        <input type="number" class="form-control" id="stok_obat" name="stok_obat" required>
    </div>
    <div class="mb-3">
        <label for="stok_minimum" class="form-label">Stok Minimum</label>
        <input type="number" class="form-control" id="stok_minimum" name="stok_minimum" required>
    </div>
    <div class="mb-3">
        <label for="satuan_obat" class="form-label">Satuan Obat</label>
        <input type="text" class="form-control" id="satuan_obat" name="satuan_obat" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_expired" class="form-label">Tanggal Expired</label>
        <input type="date" class="form-control" id="tanggal_expired" name="tanggal_expired" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection

