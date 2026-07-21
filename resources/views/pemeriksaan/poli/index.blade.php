@extends('layouts.pemeriksaan')

@section('title','Pemeriksaan Awal')

@section('page-title','Pemeriksaan Awal')

@section('content')

<div class="card">

    <div class="card-header">

        <h4>Daftar Pasien Pemeriksaan Poli</h4>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>No RM</th>

                    <th>Nama Pasien</th>

                    <th>Poli</th>

                    <th>Jaminan</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($kunjungans as $kunjungan)

                <tr>

                    <td>{{ $kunjungan->no_rekam_medis }}</td>

                    <td>{{ $kunjungan->nama_pasien }}</td>

                    <td>{{ $kunjungan->poli_tujuan }}</td>

                    <td>{{ $kunjungan->jenis_jaminan }}</td>

                    <td>

                        <span class="badge bg-warning">

                            {{ $kunjungan->status_kunjungan }}

                        </span>

                    </td>

                    <td>

                        <a
                            href="{{ route('pemeriksaan.awal.create',$kunjungan->id_kunjungan) }}"
                            class="btn btn-primary btn-sm">

                            Pemeriksaan

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Tidak ada pasien.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection