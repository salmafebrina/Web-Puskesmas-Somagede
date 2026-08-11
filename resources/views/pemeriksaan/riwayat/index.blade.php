@extends('layouts.pemeriksaan')

@section('title','Riwayat Pemeriksaan')

@section('page-title','Riwayat Pemeriksaan')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">
            Riwayat Pemeriksaan Pasien
        </h4>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>No RM</th>

                        <th>Nama Pasien</th>

                        <th>Poli</th>

                        <th>Tanggal Pemeriksaan</th>

                        <th>Status</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($kunjungans as $kunjungan)

                    <tr>

                        <td>
                            {{ $kunjungan->pasien->id_rekam_medis ?? '-' }}
                        </td>

                        <td>
                            {{ $kunjungan->pasien->nama_pasien }}
                        </td>

                        <td>
                            {{ $kunjungan->poli }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($kunjungan->created_at)->format('d-m-Y') }}
                        </td>

                        <td>

                            <span class="badge bg-success">

                                Selesai

                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route('pemeriksaan.riwayat.show',$kunjungan->id_kunjungan) }}"
                                class="btn btn-primary btn-sm">

                                <i class="fas fa-eye"></i>

                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Belum ada riwayat pemeriksaan.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection