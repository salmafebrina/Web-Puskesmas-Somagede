@extends('layouts.pemeriksaan')

@section('title','Pemeriksaan Awal')

@section('page-title','Pemeriksaan Awal')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-0">
                        Silakan pilih poli untuk melihat daftar pasien yang akan dilakukan pemeriksaan awal.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        @forelse($polis as $poli)

        <div class="col-lg-3 col-md-6 mb-4">

                <div class="card shadow border-0 h-100 poli-card">
                    <div class="card-body text-center">

                        @switch($poli->poli_tujuan)
                            @case('Poli Umum')
                                <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
                                @break
                            @case('Poli Gigi')
                                <i class="fas fa-tooth fa-3x text-success mb-3"></i>
                                @break
                            @case('Poli KIA')
                                <i class="fas fa-female fa-3x text-danger mb-3"></i>
                                @break
                            @case('Poli Anak')
                                <i class="fas fa-baby fa-3x text-warning mb-3"></i>
                                @break
                            @default
                                <i class="fas fa-hospital fa-3x text-info mb-3"></i>
                        @endswitch

                        <h5 class="fw-bold">{{ $poli->poli_tujuan }}</h5>

                        <h1 class="display-5 fw-bold text-dark">{{ $poli->jumlah_pasien }}</h1>

                        <p class="text-muted mb-4">Pasien Hari Ini</p>

                        <a href="{{ route('pemeriksaan.awal.poli', $poli->poli_tujuan) }}" class="btn btn-primary">
                            Masuk <i class="fas fa-arrow-right ms-2"></i>
                        </span>

                    </div>
                </div>

            </a>
        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-info mb-0">
                Belum ada pasien yang menunggu pemeriksaan awal hari ini.
            </div>
        </div>

        @endforelse

    </div>

</div>

<style>
.poli-card{
    transition:.25s;
    border-radius:18px;
}
.poli-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,.15)!important;
}
</style>
@endsection