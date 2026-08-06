@extends('layouts.admin')

@section('title', 'Detail Pasien')
@section('page-title', 'Detail Pasien')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-8">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">
            <i class="fas fa-user-circle me-2 text-primary"></i>
            {{ $pasien->nama_pasien }}
        </h6>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.pasien.edit', $pasien->id_pasien) }}"
               class="btn btn-warning btn-sm">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="mb-3">
                    <small class="text-muted d-block">No. Rekam Medis</small>
                    <strong>{{ $pasien->id_rekam_medis ?? '-' }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">NIK</small>
                    <strong>{{ $pasien->nik_pasien }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">No. BPJS</small>
                    <strong>{{ $pasien->id_bpjs ?? '-' }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Nama Pasien</small>
                    <strong>{{ $pasien->nama_pasien }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Nama Kepala Keluarga</small>
                    <strong>{{ $pasien->nama_kk }}</strong>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <small class="text-muted d-block">Jenis Kelamin</small>
                    <strong>{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Tanggal Lahir</small>
                    <strong>{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->translatedFormat('d F Y') }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Nomor HP</small>
                    <strong>{{ $pasien->no_hp }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Alamat</small>
                    <strong>{{ $pasien->alamat_pasien }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Status Registrasi</small>
                    <span class="badge {{ $pasien->status_registrasi == 'lengkap' ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ ucfirst($pasien->status_registrasi ?? 'draft') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection
