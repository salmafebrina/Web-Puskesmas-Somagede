@extends('layouts.pembayaran')

@section('title','Detail Riwayat Pembayaran')

@section('page-title','Detail Riwayat Pembayaran')

@section('content')

{{-- ========================= --}}
{{-- INFORMASI TRANSAKSI --}}
{{-- ========================= --}}

<div class="card mb-3">

    <div class="card-header bg-primary text-white">
        <strong>Informasi Transaksi</strong>
    </div>

    <div class="card-body">

        <table class="table table-borderless">

            <tr>
                <th width="250">No Transaksi</th>
                <td>{{ $transaksi->no_transaksi }}</td>
            </tr>

            <tr>
                <th>Tanggal Pembayaran</th>
                <td>
                    {{ \Carbon\Carbon::parse($transaksi->tanggal_pembayaran)->format('d-m-Y H:i') }}
                </td>
            </tr>

            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ $transaksi->metode_pembayaran }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-success">
                        {{ $transaksi->status_pembayaran }}
                    </span>
                </td>
            </tr>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- INFORMASI PASIEN --}}
{{-- ========================= --}}

<div class="card mb-3">

    <div class="card-header">
        <strong>Informasi Pasien</strong>
    </div>

    <div class="card-body">

        <table class="table table-borderless">

            <tr>
                <th width="250">Nama Pasien</th>
                <td>{{ $kunjungan->pasien->nama_pasien }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $kunjungan->pasien->alamat_pasien }}</td>
            </tr>

            <tr>
                <th>Jenis Jaminan</th>
                <td>{{ $kunjungan->jenis_jaminan }}</td>
            </tr>

            <tr>
                <th>Jenis Pelayanan</th>
                <td>{{ $kunjungan->jenis_pelayanan }}</td>
            </tr>

            <tr>
                <th>Poli</th>
                <td>{{ $kunjungan->poli }}</td>
            </tr>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- PEMERIKSAAN KLINIS --}}
{{-- ========================= --}}

<div class="card mb-3">

    <div class="card-header bg-primary text-white">
        <strong>Pemeriksaan Klinis</strong>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>Nama Tindakan</th>

                <th width="180" class="text-end">
                    Tarif
                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($detailTindakan as $item)

                <tr>

                    <td>{{ $item['nama'] }}</td>

                    <td class="text-end">
                        Rp {{ number_format($item['tarif'],0,',','.') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" class="text-center">
                        Tidak ada tindakan.
                    </td>

                </tr>

            @endforelse

            <tr class="table-warning">

                <th>Subtotal</th>

                <th class="text-end">

                    Rp {{ number_format($totalTindakan,0,',','.') }}

                </th>

            </tr>

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- PEMERIKSAAN PENUNJANG --}}
{{-- ========================= --}}

<div class="card mb-3">

    <div class="card-header bg-info text-white">
        <strong>Pemeriksaan Penunjang</strong>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>Nama Pemeriksaan</th>

                <th width="180" class="text-end">
                    Tarif
                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($detailPenunjang as $item)

                <tr>

                    <td>{{ $item['nama'] }}</td>

                    <td class="text-end">
                        Rp {{ number_format($item['tarif'],0,',','.') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" class="text-center">
                        Tidak ada pemeriksaan penunjang.
                    </td>

                </tr>

            @endforelse

            <tr class="table-warning">

                <th>Subtotal</th>

                <th class="text-end">
                    Rp {{ number_format($totalPenunjang,0,',','.') }}
                </th>

            </tr>

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- OBAT --}}
{{-- ========================= --}}

<div class="card mb-3">

    <div class="card-header">
        <strong>Obat-obatan</strong>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>Nama Obat</th>

                <th>Jumlah</th>

                <th>Harga</th>

                <th>Subtotal</th>

            </tr>

            </thead>

            <tbody>

            @forelse($detailObat as $item)

                <tr>

                    <td>{{ $item['nama'] }}</td>

                    <td>{{ $item['jumlah'] }}</td>

                    <td>
                        Rp {{ number_format($item['harga'],0,',','.') }}
                    </td>

                    <td>
                        Rp {{ number_format($item['subtotal'],0,',','.') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">
                        Tidak ada obat.
                    </td>

                </tr>

            @endforelse

            <tr class="table-warning">

                <th colspan="3">Total Obat</th>

                <th>
                    Rp {{ number_format($totalObat,0,',','.') }}
                </th>

            </tr>

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- TOTAL --}}
{{-- ========================= --}}

<div class="card">

    <div class="card-header">
        <strong>Total Pembayaran</strong>
    </div>

    <div class="card-body">

        <table class="table">

            <tr>
                <th>Pemeriksaan Klinis</th>
                <td class="text-end">
                    Rp {{ number_format($totalTindakan,0,',','.') }}
                </td>
            </tr>

            <tr>
                <th>Pemeriksaan Penunjang</th>
                <td class="text-end">
                    Rp {{ number_format($totalPenunjang,0,',','.') }}
                </td>
            </tr>

            <tr>
                <th>Obat-obatan</th>
                <td class="text-end">
                    Rp {{ number_format($totalObat,0,',','.') }}
                </td>
            </tr>

            <tr>
                <th>Ambulance</th>
                <td class="text-end">
                    Rp {{ number_format($totalAmbulance,0,',','.') }}
                </td>
            </tr>

            <tr class="table-success">

                <th>TOTAL</th>

                <th class="text-end">
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </th>

            </tr>

        </table>

    </div>

</div>

<div class="mt-4">

    <a href="{{ route('pembayaran.riwayat.index') }}"
       class="btn btn-secondary">

        Kembali

    </a>

    <a href="{{ route('pembayaran.transaksi.cetak', $kunjungan->id_kunjungan) }}"
       target="_blank"
       class="btn btn-primary">

        Cetak Struk

    </a>

</div>

@endsection