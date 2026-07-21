@extends('layouts.pendaftaran')

@section('title', 'Cetak Antrian')

@section('page-title', 'Cetak Antrian')

@section('content')

<div class="d-flex justify-content-end align-items-start mb-4">


    <div class="d-flex gap-3">

        <div class="card shadow-sm text-center" style="width:140px;">
            <div class="card-body">
                <h6>Reguler</h6>
                <h2>{{ $jumlahReguler }}</h2>
            </div>
        </div>

        <div class="card shadow-sm text-center" style="width:140px;">
            <div class="card-body">
                <h6>Prioritas</h6>
                <h2>{{ $jumlahPrioritas }}</h2>
            </div>
        </div>

    </div>

</div>

<div class="row justify-content-center">

    <div class="col-md-5">

        <div class="card shadow">

            <div class="card-body text-center">

                <h3>Cetak Antrian</h3>

                <p class="text-muted">

                    Buat nomor antrian pasien berdasarkan poli tujuan.

                </p>

                <a href="{{ route('antrian.create') }}"
                    class="btn btn-primary">

                    Buka

                </a>

            </div>

        </div>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header">

        <h5>Daftar Antrian Hari Ini</h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>No</th>

                    <th>No Antrian</th>

                    <th>NIK</th>

                    <th>Poli Tujuan</th>

                    <th>Jenis Antrian</th>

                    <th>Status Pasien</th>

                    <th>Status Antrian</th>

                </tr>

            </thead>

            <tbody>

            @forelse($antrians as $index => $antrian)

                <tr>

                    <td>{{ $index+1 }}</td>

                    <td>{{ $antrian->kode_antrian }}</td>

                    <td>{{ $antrian->nik_pasien }}</td>

                    <td>{{ $antrian->poli_tujuan }}</td>

                    <td>{{ $antrian->jenis_antrian }}</td>

                    <td>

                        @if($antrian->status_pasien == 'Pasien Baru')

                            <span class="badge bg-warning">

                                Pasien Baru

                            </span>

                        @else

                            <span class="badge bg-success">

                                Pasien Lama

                            </span>

                        @endif

                    </td>

                    <td>

                        <span class="badge bg-primary">

                            {{ $antrian->status_antrian }}

                        </span>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada data antrian.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>

function updateClock(){

    const now = new Date();

    document.getElementById('live-clock').innerHTML =
        now.toLocaleTimeString('id-ID');

}

updateClock();

setInterval(updateClock,1000);

</script>

@endsection