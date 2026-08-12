@extends('layouts.pendaftaran')

@section('title', 'Detail Antrian')

@section('page-title', 'Detail Antrian')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body text-center">

                <h5 class="mb-4">
                    Nomor Antrian
                </h5>

                <h1
                    style="
                        font-size:70px;
                        font-weight:bold;
                    ">
                    {{ $antrian->kode_antrian }}
                </h1>

                <hr>

                <table class="table">

                    <tr>
                        <th>NIK</th>
                        <td>{{ $antrian->nik_pasien }}</td>
                    </tr>

                    <tr>
                        <th>Poli Tujuan</th>
                        <td>{{ $antrian->poli_tujuan }}</td>
                    </tr>

                    <tr>
                        <th>Jenis Jaminan</th>
                        <td>{{ $antrian->jenis_jaminan }}</td>
                    </tr>

                    <tr>
                        <th>Jenis Antrian</th>
                        <td>
                            @if($antrian->jenis_antrian == 'Prioritas')
                                <span class="badge bg-warning text-dark">
                                    Prioritas
                                </span>
                            @else
                                <span class="badge bg-primary">
                                    Reguler
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status Pasien</th>
                        <td>
                            @if($antrian->status_pasien == 'Pasien Baru')
                                <span class="badge bg-warning text-dark">
                                    Pasien Baru
                                </span>
                            @else
                                <span class="badge bg-success">
                                    Pasien Lama
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $antrian->tanggal_kunjungan}}</td>
                    </tr>

                </table>

                <button
                    onclick="window.print()"
                    class="btn btn-success">

                    Cetak Antrian

                </button>

                <a href="{{ route('antrian.index') }}"
                class="btn btn-success">
                <i class="bi bi-check-circle"></i> Selesai
                </a>

            </div>

        </div>

    </div>

</div>

@endsection