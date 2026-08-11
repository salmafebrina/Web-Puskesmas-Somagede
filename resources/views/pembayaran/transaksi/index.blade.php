@extends('layouts.pembayaran')

@section('title', 'Pembayaran')

@section('content')

<div class="container">

    <h4 class="mb-4">Data Pembayaran</h4>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Tanggal</th>

                        <th>No RM</th>

                        <th>Nama Pasien</th>

                        <th>Jenis Pembiayaan</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($kunjungans as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->tanggal_kunjungan }}</td>

                        <td>{{ $item->pasien->id_rekam_medis ?? '-' }}</td>

                        <td>{{ $item->pasien->nama_pasien }}</td>

                        <td>{{ $item->jenis_pembiayaan }}</td>

                        <td>

                            <span class="badge bg-warning">

                                {{ $item->status_kunjungan }}

                            </span>

                        </td>

                        <td>

                            <a href="{{ route('pembayaran.show', $item->id_kunjungan) }}"

                               class="btn btn-success btn-sm">

                                Bayar

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Tidak ada pasien menunggu pembayaran.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection