@extends('layouts.pemeriksaan')

@section('title', 'Pemeriksaan Awal - ' . $namaPoli)

@section('page-title', 'Pemeriksaan Awal')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">{{ $namaPoli }}</h4>
            <p class="text-muted mb-0">
                Daftar pasien menunggu pemeriksaan awal hari ini.
            </p>
        </div>

        <a href="{{ route('pemeriksaan.awal.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>

    </div>

    {{-- ================= PRIORITAS ================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">
                <i class="fas fa-star me-2"></i>
                Antrian Prioritas
                <span class="badge bg-light text-danger ms-2">
                    {{ $prioritas->count() }}
                </span>
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>No</th>
                            <th>No Antrian</th>
                            <th>Nama Pasien</th>
                            <th>JK</th>
                            <th>Umur</th>
                            <th>Penjamin</th>
                            <th width="170">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($prioritas as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->kode_kunjungan }}</td>

                            <td>{{ $item->nama_pasien }}</td>

                            <td>{{ $item->jenis_kelamin }}</td>

                            <td>{{ $item->usia }}</td>

                            <td>{{ $item->jenis_jaminan }}</td>

                            <td>

                                <button
                                    class="btn btn-info btn-sm">
                                    Detail
                                </button>

                                <a
                                    href="{{ route('pemeriksaan.awal.create',$item->id_kunjungan) }}"
                                    class="btn btn-danger btn-sm">

                                    Periksa

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                Tidak ada pasien prioritas.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- ================= REGULER ================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="fas fa-users me-2"></i>

                Antrian Reguler

                <span class="badge bg-light text-primary ms-2">

                    {{ $reguler->count() }}

                </span>

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>No</th>
                            <th>No Antrian</th>
                            <th>Nama Pasien</th>
                            <th>JK</th>
                            <th>Umur</th>
                            <th>Penjamin</th>
                            <th width="170">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($reguler as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->kode_kunjungan }}</td>

                            <td>{{ $item->nama_pasien }}</td>

                            <td>{{ $item->jenis_kelamin }}</td>

                            <td>{{ $item->usia }}</td>

                            <td>{{ $item->jenis_jaminan }}</td>

                            <td>

                                <button
                                    class="btn btn-info btn-sm">
                                    Detail
                                </button>

                                <a
                                    href="{{ route('pemeriksaan.awal.create',$item->id_kunjungan) }}"
                                    class="btn btn-primary btn-sm">

                                    Periksa

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                Tidak ada pasien reguler.

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