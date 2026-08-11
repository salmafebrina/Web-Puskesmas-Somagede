@extends('layouts.pembayaran')

@section('title','Riwayat Pembayaran')

@section('page-title','Riwayat Pembayaran')

@section('content')

<div class="card">

    <div class="card-header">
        <strong>Filter Riwayat Pembayaran</strong>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('pembayaran.riwayat.index') }}">

            <div class="row mb-3">

                <div class="col-md-3">
                    <label>Tanggal</label>
                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ request('tanggal', date('Y-m-d')) }}">
                </div>

                <div class="col-md-5">
                    <label>Cari Nama Pasien</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Nama Pasien"
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2 d-grid">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary">
                        Filter
                    </button>
                </div>

                <div class="col-md-2 d-grid">
                    <label>&nbsp;</label>
                    <a
                        href="{{ route('pembayaran.riwayat.index') }}"
                        class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>

        </form>

    </div>

</div>


<div class="card mt-3">

    <div class="card-header">
        <strong>Daftar Riwayat Pembayaran</strong>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped align-middle">

            <thead class="table-light">

                <tr>

                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Poli</th>
                    <th>Jenis Pelayanan</th>
                    <th>Jaminan</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="90">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($transaksis as $i => $transaksi)

                <tr>

                    <td>{{ $i+1 }}</td>

                    <td>{{ $transaksi->no_transaksi }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_pembayaran)->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $transaksi->kunjungan->pasien->nama_pasien }}
                    </td>

                    <td>
                        {{ $transaksi->kunjungan->poli ?? '-' }}
                    </td>

                    <td>
                        {{ $transaksi->kunjungan->jenis_pelayanan ?? '-' }}
                    </td>

                    <td>
                        {{ $transaksi->kunjungan->jenis_jaminan ?? '-' }}
                    </td>

                    <td>
                        {{ $transaksi->metode_pembayaran }}
                    </td>

                    <td>
                        Rp {{ number_format($transaksi->total_pembayaran,0,',','.') }}
                    </td>

                    <td>

                        <span class="badge bg-success">

                            {{ $transaksi->status_pembayaran }}

                        </span>

                    </td>

                    <td>

                        <a href="{{ route('pembayaran.riwayat.show', $transaksi->id_transaksi) }}"
                        class="btn btn-info btn-sm">
                        Detail

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="11" class="text-center">

                        Tidak ada data pembayaran.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection