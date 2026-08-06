@extends('layouts.admin')

@section('title', 'Data Obat')
@section('page-title', 'Data Obat')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><i class="fas fa-pills me-2 text-primary"></i>Daftar Obat</h6>
        <a href="{{ route('admin.obat.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Obat
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('admin.obat.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama obat atau kategori..."
                           value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                @if($search)
                <div class="col-md-1">
                    <a href="{{ route('admin.obat.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="4%">No</th>
                        <th>Nama Obat</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Min. Stok</th>
                        <th>Satuan</th>
                        <th>Kadaluarsa</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obats as $i => $obat)
                    <tr class="{{ $obat->stok_obat <= $obat->stok_minimum ? 'table-warning' : '' }}">
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->jenis_obat }}</td>
                        <td>{{ $obat->kategori_obat }}</td>
                        <td>
                            <span class="fw-bold {{ $obat->stok_obat <= $obat->stok_minimum ? 'text-danger' : '' }}">
                                {{ $obat->stok_obat }}
                            </span>
                            @if($obat->stok_obat <= $obat->stok_minimum)
                                <span class="badge bg-danger ms-1">Stok Rendah</span>
                            @endif
                        </td>
                        <td>{{ $obat->stok_minimum }}</td>
                        <td>{{ $obat->satuan_obat }}</td>
                        <td>
                            @php $exp = \Carbon\Carbon::parse($obat->tanggal_expired); @endphp
                            <span class="{{ $exp->isPast() ? 'text-danger fw-bold' : '' }}">
                                {{ $exp->format('d/m/Y') }}
                            </span>
                            @if($exp->isPast())
                                <span class="badge bg-danger">Expired</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.obat.edit', $obat->id_obat) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.obat.destroy', $obat->id_obat) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus obat {{ $obat->nama_obat }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Belum ada data obat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
