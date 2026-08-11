@extends('layouts.farmasi')

@section('title','Detail Riwayat Penyerahan')

@section('content')

<div class="container-fluid">

<h2 class="fw-bold mb-4">
    Detail Penyerahan Obat
</h2>

<div class="card mb-4">

<div class="card-header bg-primary text-white">

Informasi Pasien

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>Nama Pasien</label>

<input
class="form-control"
readonly
value="{{ $riwayat->resep->pemeriksaan->kunjungan->pasien->nama_pasien }}">

</div>

<div class="col-md-3">

<label>Tanggal Penyerahan</label>

<input
class="form-control"
readonly
value="{{ \Carbon\Carbon::parse($riwayat->tanggal_penyerahan)->format('d-m-Y H:i') }}">

</div>

<div class="col-md-3">

<label>Status</label>

<input
class="form-control"
readonly
value="Selesai">

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header bg-success text-white">

Daftar Obat

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Obat</th>
<th>Jumlah</th>
<th>Aturan Pakai</th>

</tr>

</thead>

<tbody>

@foreach($riwayat->resep->detailObat as $detail)

<tr>

<td>{{ $detail->obat->nama_obat }}</td>

<td>{{ $detail->jumlah }}</td>

<td>{{ $detail->aturan_pakai }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<div class="mt-4">

<a
href="{{ route('farmasi.riwayat.index') }}"
class="btn btn-secondary">

Kembali

</a>

</div>

@endsection