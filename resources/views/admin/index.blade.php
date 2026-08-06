@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:54px;height:54px;background:#e8f1ff;">
                    <i class="fas fa-users fa-lg" style="color:#2F80ED;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total User</div>
                    <div class="fw-bold fs-3">{{ $totalUser }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:54px;height:54px;background:#e8f7ee;">
                    <i class="fas fa-user-injured fa-lg" style="color:#27AE60;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pasien</div>
                    <div class="fw-bold fs-3">{{ $totalPasien }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:54px;height:54px;background:#fff4e5;">
                    <i class="fas fa-pills fa-lg" style="color:#F39C12;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Obat</div>
                    <div class="fw-bold fs-3">{{ $totalObat }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:54px;height:54px;background:#fdecea;">
                    <i class="fas fa-calendar-check fa-lg" style="color:#E74C3C;"></i>
                </div>
                <div>
                    <div class="text-muted small">Kunjungan Hari Ini</div>
                    <div class="fw-bold fs-3">{{ $kunjunganHariIni }}</div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="fas fa-link me-2 text-primary"></i>Akses Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-outline-primary text-start">
                        <i class="fas fa-user-plus me-2"></i> Tambah User Baru
                    </a>
                    <a href="{{ route('admin.pasien.index') }}" class="btn btn-outline-success text-start">
                        <i class="fas fa-user-injured me-2"></i> Kelola Data Pasien
                    </a>
                    <a href="{{ route('admin.obat.create') }}" class="btn btn-outline-warning text-start">
                        <i class="fas fa-pills me-2"></i> Tambah Obat
                    </a>
                    <a href="{{ route('admin.tarif.create') }}" class="btn btn-outline-info text-start">
                        <i class="fas fa-receipt me-2"></i> Tambah Tarif
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2 text-primary"></i>Info Sistem</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" width="50%">Versi Laravel</td>
                        <td><span class="badge bg-primary">10.x</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">PHP</td>
                        <td><span class="badge bg-secondary">{{ PHP_VERSION }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Server Time</td>
                        <td>{{ now()->format('d/m/Y H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Login sebagai</td>
                        <td><strong>{{ auth()->user()->name ?? 'Admin' }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
