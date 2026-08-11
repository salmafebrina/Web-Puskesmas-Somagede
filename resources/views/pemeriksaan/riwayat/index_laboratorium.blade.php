@extends('layouts.pemeriksaan')

@section('title','Pasien Laboratorium')

@section('page-title','Pasien Laboratorium')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                Riwayat Pasien Laboratorium
            </h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>

                        <th>No</th>

                        <th>Tanggal</th>

                        <th>Nama Pasien</th>

                        <th>Diagnosa</th>

                        <th>Plan</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pemeriksaans as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->created_at->format('d-m-Y') }}</td>

                            <td>{{ $item->kunjungan->nama_pasien }}</td>

                            <td>{{ $item->diagnosa }}</td>

                            <td>{{ $item->plan }}</td>

                            <td>

                                <a
                                    href="#"
                                    class="btn btn-sm btn-primary">

                                    Detail

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                Belum ada pasien laboratorium.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection