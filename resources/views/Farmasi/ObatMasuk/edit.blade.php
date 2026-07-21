@extends('layouts.farmasi')

@section('title','Edit Obat Masuk')

@section('page-title','Edit Obat Masuk')

@section('content')

<form action="{{ route('obat-masuk.update',$obatMasuk->id_obat_masuk) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="card">

        <div class="card-body">

            <div class="mb-3">

                <label>Nama Obat</label>

                <select name="id_obat" class="form-control">

                    @foreach($obats as $obat)

                        <option
                            value="{{ $obat->id_obat }}"
                            {{ $obat->id_obat == $obatMasuk->id_obat ? 'selected' : '' }}>

                            {{ $obat->nama_obat }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Tanggal Masuk</label>

                <input
                    type="date"
                    name="tanggal_masuk"
                    class="form-control"
                    value="{{ $obatMasuk->tanggal_masuk }}">

            </div>

            <div class="mb-3">

                <label>Jumlah Masuk</label>

                <input
                    type="number"
                    name="jumlah_masuk"
                    class="form-control"
                    value="{{ $obatMasuk->jumlah_masuk }}">

            </div>

            <div class="mb-3">

                <label>Keterangan</label>

                <textarea
                    name="keterangan"
                    class="form-control">{{ $obatMasuk->keterangan }}</textarea>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-success">

                Update

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