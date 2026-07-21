@extends('layouts.pembayaran')

@section('title','Riwayat Pembayaran')

@section('page-title','Riwayat Pembayaran')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Riwayat Pembayaran
        </h4>

        <div>

            <input
                type="text"
                class="form-control"
                placeholder="Cari Nama / No RM">

        </div>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped table-hover">

            <thead class="table-primary">

                <tr>

                    <th>No Invoice</th>

                    <th>No RM</th>

                    <th>Nama Pasien</th>

                    <th>Poli</th>

                    <th>Total</th>

                    <th>Metode</th>

                    <th>Status</th>

                    <th>Tanggal</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($pembayarans ?? [] as $pembayaran)

                <tr>

                    <td>
                        {{ $pembayaran->kode_invoice }}
                    </td>

                    <td>
                        {{ $pembayaran->id_pasien }}
                    </td>

                    <td>
                        {{ $pembayaran->nama_pasien }}
                    </td>

                    <td>
                        {{ $pembayaran->poli_tujuan }}
                    </td>

                    <td>

                        Rp {{ number_format($pembayaran->total_bayar,0,',','.') }}

                    </td>

                    <td>

                        @if($pembayaran->metode_pembayaran=="QRIS")

                            <span class="badge bg-info">

                                QRIS

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Tunai

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($pembayaran->status_pembayaran=="Lunas")

                            <span class="badge bg-success">

                                Lunas

                            </span>

                        @else

                            <span class="badge bg-warning text-dark">

                                Belum Lunas

                            </span>

                        @endif

                    </td>

                    <td>

                        {{ $pembayaran->created_at }}

                    </td>

                    <td>

                        <button
                            class="btn btn-primary btn-sm">

                            Detail

                        </button>

                        <button
                            class="btn btn-success btn-sm">

                            Cetak

                        </button>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">

                        Belum ada riwayat pembayaran.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection