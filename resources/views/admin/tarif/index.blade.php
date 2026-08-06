@extends('layouts.admin')

@section('title', 'Data Tarif')
@section('page-title', 'Data Tarif Pelayanan')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><i class="fas fa-receipt me-2 text-primary"></i>Daftar Tarif</h6>
        <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Tarif
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('admin.tarif.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama atau kategori tarif..."
                           value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                @if($search)
                <div class="col-md-1">
                    <a href="{{ route('admin.tarif.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="4%">No</th>
                        <th>Kode</th>
                        <th>Nama Tarif</th>
                        <th>Kategori</th>
                        <th>Biaya</th>
                        <th width="10%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tarifs as $i => $tarif)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><span class="badge bg-secondary">{{ $tarif->kode_tarif }}</span></td>
                        <td>{{ $tarif->nama_tarif }}</td>
                        <td>{{ $tarif->kategori_tarif }}</td>
                        <td>Rp {{ number_format($tarif->biaya_tarif, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $tarif->status_tarif == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $tarif->status_tarif }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.tarif.edit', $tarif->id_tarif) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus tarif {{ $tarif->nama_tarif }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data tarif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
