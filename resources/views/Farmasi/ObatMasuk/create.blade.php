@extends('layouts.farmasi')

@section('title','Tambah Obat Masuk')

@section('page-title','Tambah Obat Masuk')

@section('content')

<form action="{{ route('obat-masuk.store') }}" method="POST">

    @csrf

    <div class="card">

        <div class="card-body">

            <div class="mb-3">

                <label>Nama Obat</label>

                <input
                    name="nama_obat"
                    type="text"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Tanggal Masuk</label>

                <input
                    type="date"
                    name="tanggal_masuk"
                    class="form-control"
                    value="{{ date('Y-m-d') }}"
                    required>

            </div>

            <div class="mb-3">

                <label>Jumlah Masuk</label>

                <input
                    type="number"
                    name="jumlah_masuk"
                    class="form-control"
                    min="1"
                    required>

            </div>

            <div class="mb-3">

                <label>Keterangan</label>

                <textarea
                    name="keterangan"
                    class="form-control"
                    rows="3"></textarea>

            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-success">

                Simpan

            </button>

            <a
                href="{{ route('obat-masuk.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</form>

@endsection