@extends('layouts.pemeriksaan')

@section('title', 'Riwayat Pemeriksaan')

@section('page-title', 'Riwayat Pemeriksaan')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white py-3">

        <div class="d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Riwayat Pemeriksaan Pasien
            </h4>

            <form
                method="GET"
                action="{{ route('pemeriksaan.riwayat.index') }}"
                class="d-flex align-items-center gap-2"
            >

                <label class="mb-0">
                    Tanggal:
                </label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ $tanggal }}"
                    class="form-control"
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Tampilkan
                </button>

            </form>

        </div>

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

                        <th>Tanggal Pemeriksaan</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($pemeriksaans as $pemeriksaan)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $pemeriksaan->kunjungan->pasien->no_rm ?? '-' }}
                            </td>

                            <td>
                                {{ $pemeriksaan->kunjungan->pasien->nama_pasien ?? '-' }}
                            </td>

                            <td>
                                {{ $pemeriksaan->kunjungan->poli_tujuan ?? '-' }}
                            </td>

                            <td>
                                {{ $pemeriksaan->created_at
                                    ? $pemeriksaan->created_at->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            </td>

                            <td>

                                <a
                                    href="{{ route(
                                        'pemeriksaan.riwayat.show',
                                        $pemeriksaan->id_pemeriksaan
                                    ) }}"
                                    class="btn btn-primary btn-sm"
                                >
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-4"
                            >

                                <div class="text-muted">

                                    Tidak ada riwayat pemeriksaan
                                    pada tanggal
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}.

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