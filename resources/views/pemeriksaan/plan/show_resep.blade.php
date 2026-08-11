@extends('layouts.pemeriksaan')

@section('title','Detail Resep')

@section('page-title','Detail Resep')

@section('content')

<div class="container">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4 class="mb-0">

💊 Detail Resep

</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Obat</th>

<th>Jumlah</th>

<th>Aturan Pakai</th>

</tr>

</thead>

<tbody>

@foreach($resep->detailPenggunaanObat as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->obat->nama_obat }}</td>

<td>{{ $item->jumlah }}</td>

<td>{{ $item->aturan_pakai }}</td>

</tr>

@endforeach

</tbody>

</table>

<a
href="{{ url()->previous() }}"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

@endsection