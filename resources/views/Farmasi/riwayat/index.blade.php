@extends('layouts.farmasi')

@section('content')

<div class="container-fluid">

<h2 class="fw-bold mb-4">

Riwayat Penyerahan Obat

</h2>

<div class="card shadow-sm">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Pasien</th>

<th>Poli</th>

<th>Dokter</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($riwayats as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>

{{ \Carbon\Carbon::parse($item->tanggal_penyerahan)->format('d-m-Y H:i') }}

</td>

<td>

{{ $item->resep->pemeriksaan->kunjungan->pasien->nama_pasien }}

</td>

<td>

nanti ditambahin

</td>

<td>

{{ $item->resep->pemeriksaan->dokter }}

</td>

<td>

<span class="badge bg-success">

Selesai

</span>

</td>

<td>

<a
href="{{ route('farmasi.riwayat.show',$item->id_penyerahan) }}"
class="btn btn-primary btn-sm">

Detail

</a>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center">

Belum ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@endsection