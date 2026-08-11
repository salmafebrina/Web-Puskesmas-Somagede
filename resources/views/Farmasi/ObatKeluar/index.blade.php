@extends('layouts.farmasi')

@section('title', 'Antrian Resep')

@section('page-title', 'Antrian Resep')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">
            Daftar Antrian Resep
        </h5>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary text-center">

                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>No Rekam Medis</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($reseps as $index => $resep)

                    <tr>

                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($resep->tanggal_resep)->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ $resep->pemeriksaan->id_pemeriksaan ?? '-' }}
                        </td>

                        <td>
                            {{ $resep->pemeriksaan->kunjungan->pasien->nama_pasien ?? '-' }}
                        </td>

                        <td>
                            {{ $resep->pemeriksaan->dokter ?? '-' }}
                        </td>

                        <td class="text-center">

                            @if($resep->status == 'Menunggu Penyiapan')

                                <span class="badge bg-warning text-dark">
                                    Menunggu Penyiapan
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <a href="{{ route('farmasi.ObatKeluar.create', $resep->id_resep) }}"
                               class="btn btn-primary btn-sm">

                                <i class="bi bi-eye"></i>
                                Detail

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center text-muted">

                            Belum ada antrian resep.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection