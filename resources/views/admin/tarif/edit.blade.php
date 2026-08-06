@extends('layouts.admin')

@section('title', 'Edit Tarif')
@section('page-title', 'Edit Data Tarif')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-6">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">
            <i class="fas fa-edit me-2 text-primary"></i>Edit — {{ $tarif->nama_tarif }}
        </h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.tarif.update', $tarif->id_tarif) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Tarif</label>
                <input type="text" class="form-control bg-light" value="{{ $tarif->kode_tarif }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Tarif <span class="text-danger">*</span></label>
                <input type="text" name="nama_tarif"
                       class="form-control @error('nama_tarif') is-invalid @enderror"
                       value="{{ old('nama_tarif', $tarif->nama_tarif) }}">
                @error('nama_tarif')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select name="kategori_tarif" class="form-select @error('kategori_tarif') is-invalid @enderror">
                    @foreach(['Pemeriksaan','Tindakan','Surat'] as $k)
                    <option value="{{ $k }}" {{ old('kategori_tarif', $tarif->kategori_tarif) == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kategori_tarif')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Biaya (Rp) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="biaya_tarif" min="0"
                           class="form-control @error('biaya_tarif') is-invalid @enderror"
                           value="{{ old('biaya_tarif', $tarif->biaya_tarif) }}">
                </div>
                @error('biaya_tarif')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <select name="status_tarif" class="form-select @error('status_tarif') is-invalid @enderror">
                    <option value="Aktif"    {{ old('status_tarif', $tarif->status_tarif) == 'Aktif'    ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ old('status_tarif', $tarif->status_tarif) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status_tarif')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
