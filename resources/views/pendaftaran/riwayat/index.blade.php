@extends('layouts.pendaftaran')

@section('title','Riwayat Pendaftaran')

@section('page-title','Riwayat Pendaftaran')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card mb-4">

    <div class="card-body">

        <form method="GET"
              action="{{ route('pendaftaran.riwayat.index') }}">

            <div class="row">

                <div class="col-md-4">

                    <label class="form-label">

                        Tanggal Pelayanan

                    </label>

                    <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ $tanggal }}">
                </div>

                <div class="col-md-4 d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-primary me-2">

                        Tampilkan

                    </button>

                    <a href="{{ route('pendaftaran.riwayat.index') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Riwayat Pendaftaran
        </h4>

        <form method="GET" class="d-flex">

            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari Nama / NIK / No RM">

            <button
                class="btn btn-primary">

                Cari

            </button>

        </form>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                <tr>

                    <th>No</th>

                    <th>No RM</th>

                    <th>Nama Pasien</th>

                    <th>Poli</th>

                    <th>Jaminan</th>

                    <th>Status</th>

                    <th width="170">
                        Aksi
                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($kunjungans as $kunjungan)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $kunjungan->no_rekam_medis }}
                    </td>

                    <td>
                        {{ $kunjungan->nama_pasien }}
                    </td>

                    <td>
                        {{ $kunjungan->poli_tujuan }}
                    </td>

                    <td>
                        {{ $kunjungan->jenis_jaminan }}
                    </td>

                    <td>

                        @if($kunjungan->status_kunjungan == 'Menunggu Pemeriksaan Awal')

                            <span class="badge bg-warning">

                                {{ $kunjungan->status_kunjungan }}

                            </span>

                        @elseif($kunjungan->status_kunjungan == 'Menunggu Pemeriksaan Poli')

                            <span class="badge bg-info">

                                {{ $kunjungan->status_kunjungan }}

                            </span>

                        @elseif($kunjungan->status_kunjungan == 'Menunggu Pembayaran')

                            <span class="badge bg-primary">

                                {{ $kunjungan->status_kunjungan }}

                            </span>

                        @else

                            <span class="badge bg-success">

                                {{ $kunjungan->status_kunjungan }}

                            </span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route('pendaftaran.riwayat.show',$kunjungan->id_kunjungan) }}"
                            class="btn btn-info btn-sm">

                            Detail

                        </a>

                        <a
                            href="{{ route('pendaftaran.riwayat.edit',$kunjungan->id_kunjungan) }}"
                            class="btn btn-warning btn-sm">

                            Edit

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