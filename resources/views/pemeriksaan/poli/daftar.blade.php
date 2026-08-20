@extends('layouts.pemeriksaan')

@section('title', 'Daftar Pasien Pemeriksaan Poli')

@section('page-title', 'Daftar Pasien Pemeriksaan Poli')

@section('content')

<style>

    /* =========================
       HEADER
    ========================= */

    .page-intro {
        background: #ffffff;
        border-radius: 14px;
        padding: 20px 24px;
        margin-bottom: 20px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.06);
    }

    .page-intro h5 {
        margin: 0;
        color: #102347;
        font-weight: 700;
    }

    .page-intro p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }


    /* =========================
       CARD
    ========================= */

    .patient-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 20px;
    }


    /* =========================
       HEADER PRIORITAS
    ========================= */

    .priority-header {
        background: #fbbf24;
        color: #102347;
        padding: 14px 20px;
    }


    /* =========================
       HEADER REGULER
    ========================= */

    .regular-header {
        background: #2563eb;
        color: white;
        padding: 14px 20px;
    }


    .queue-title {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .queue-count {
        margin-left: 6px;
        font-size: 13px;
    }


    /* =========================
       TABLE
    ========================= */

    .patient-table {
        margin-bottom: 0;
        white-space: nowrap;
    }

    .patient-table th {
        background: #f1f5f9;
        color: #102347;
        font-weight: 600;
        vertical-align: middle;
    }

    .patient-table td {
        vertical-align: middle;
    }

    .patient-table tbody tr:hover {
        background: #f8fafc;
    }


    /* =========================
       STATUS
    ========================= */

    .badge-menunggu {
        background: #fff3cd;
        color: #856404;
        font-weight: 500;
    }


    /* =========================
       BUTTON
    ========================= */

    .btn-periksa {
        border-radius: 7px;
        padding: 7px 14px;
    }

    .btn-kembali {
        margin-bottom: 18px;
    }


    /* =========================
       EMPTY
    ========================= */

    .empty-state {
        padding: 30px 15px;
        text-align: center;
        color: #6b7280;
    }

    .empty-icon {
        font-size: 30px;
        margin-bottom: 8px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .patient-table {
            font-size: 13px;
        }

        .patient-table th,
        .patient-table td {
            padding: 10px;
        }

    }

</style>


{{-- ==========================================
     INFORMASI POLI
========================================== --}}

<div class="page-intro">

    <h5>
        Daftar Pasien {{ $namaPoli }}
    </h5>

    <p>
        Berikut merupakan daftar pasien yang menunggu
        pemeriksaan di {{ $namaPoli }}.
    </p>

</div>


{{-- ==========================================
     KEMBALI
========================================== --}}

<a
    href="{{ route('pemeriksaan.poli.index') }}"
    class="btn btn-secondary btn-sm btn-kembali">

    ← Kembali ke Daftar Poli

</a>


{{-- ==========================================
     PRIORITAS
========================================== --}}

<div class="card patient-card">

    <div class="priority-header">

        <h6 class="queue-title">

            📌 Daftar Pasien Prioritas

            <span class="badge bg-dark queue-count">
                {{ $prioritas->count() }}
            </span>

        </h6>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-bordered table-hover patient-table">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>No Kunjungan</th>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Jaminan</th>
                        <th>Jenis Pelayanan</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                @forelse($prioritas as $i => $kunjungan)

                    <tr>

                        <td>{{ $i + 1 }}</td>

                        <td>
                            {{ $kunjungan->kode_kunjungan ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->pasien->no_rm ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->pasien->nama_pasien ?? '-' }}
                        </td>

                        <td>

                            @if(($kunjungan->pasien->jenis_kelamin ?? '') == 'L')
                                Laki-laki
                            @elseif(($kunjungan->pasien->jenis_kelamin ?? '') == 'P')
                                Perempuan
                            @else
                                -
                            @endif

                        </td>

                        <td>
                            {{ $kunjungan->jenis_jaminan ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->jenis_pelayanan ?? '-' }}
                        </td>

                        <td>

                            <span class="badge badge-menunggu">
                                Menunggu Pemeriksaan
                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route(
                                    'pemeriksaan.poli.create',
                                    $kunjungan->id_kunjungan
                                ) }}"
                                class="btn btn-primary btn-sm btn-periksa">

                                Periksa

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    📋
                                </div>

                                Tidak ada pasien prioritas
                                yang menunggu pemeriksaan.

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ==========================================
     REGULER
========================================== --}}

<div class="card patient-card">

    <div class="regular-header">

        <h6 class="queue-title">

            📌 Daftar Pasien Reguler

            <span class="badge bg-light text-dark queue-count">
                {{ $reguler->count() }}
            </span>

        </h6>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-bordered table-hover patient-table">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>No Kunjungan</th>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Jaminan</th>
                        <th>Jenis Pelayanan</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                @forelse($reguler as $i => $kunjungan)

                    <tr>

                        <td>{{ $i + 1 }}</td>

                        <td>
                            {{ $kunjungan->kode_kunjungan ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->pasien->no_rm ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->pasien->nama_pasien ?? '-' }}
                        </td>

                        <td>

                            @if(($kunjungan->pasien->jenis_kelamin ?? '') == 'L')
                                Laki-laki
                            @elseif(($kunjungan->pasien->jenis_kelamin ?? '') == 'P')
                                Perempuan
                            @else
                                -
                            @endif

                        </td>

                        <td>
                            {{ $kunjungan->jenis_jaminan ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->jenis_pelayanan ?? '-' }}
                        </td>

                        <td>

                            <span class="badge badge-menunggu">
                                Menunggu Pemeriksaan
                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route(
                                    'pemeriksaan.poli.create',
                                    $kunjungan->id_kunjungan
                                ) }}"
                                class="btn btn-primary btn-sm btn-periksa">

                                Periksa

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    📋
                                </div>

                                Tidak ada pasien reguler
                                yang menunggu pemeriksaan.

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection