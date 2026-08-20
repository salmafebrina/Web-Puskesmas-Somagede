@extends('layouts.farmasi')

@section('title', 'Riwayat Penyerahan Obat')

@section('content')

<div class="container-fluid">

    <h1 class="mb-4">Riwayat Penyerahan Obat</h1>

    {{-- FILTER TANGGAL --}}
    <div class="card mb-4">
        <div class="card-body">

            <form method="GET"
                  action="{{ route('farmasi.riwayat.index') }}"
                  class="row align-items-end g-3">

                <div class="col-md-4">

                    <label for="tanggal" class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        class="form-control"
                        value="{{ $tanggal }}"
                    >

                </div>

                <div class="col-md-auto">

                    <button type="submit"
                            class="btn btn-primary">
                        Tampilkan
                    </button>

                </div>

                <div class="col-md-auto">

                    <a href="{{ route('farmasi.riwayat.index') }}"
                       class="btn btn-secondary">
                        Hari Ini
                    </a>

                </div>

            </form>

        </div>
    </div>


    {{-- TABEL RIWAYAT --}}
    <div class="card">

        <div class="card-header">
            <strong>
                Riwayat Penyerahan
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
            </strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal & Jam</th>
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

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->created_at->format('d-m-Y H:i') }}
                                </td>

                                <td>
                                    {{ $item->kunjungan->pasien->nama_pasien ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->kunjungan->poli_tujuan ?? '-' }}
                                </td>

                                <td>
                                    -
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        Selesai
                                    </span>
                                </td>

                                <td>

                                    <a href="#"
                                       class="btn btn-primary btn-sm">
                                        Detail
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-4">

                                    Tidak ada riwayat penyerahan
                                    obat pada tanggal ini.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection