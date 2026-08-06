@extends('layouts.admin')

@section('title', 'Tambah Obat')
@section('page-title', 'Tambah Data Obat')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i>Form Tambah Obat</h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.obat.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat"
                           class="form-control @error('nama_obat') is-invalid @enderror"
                           value="{{ old('nama_obat') }}">
                    @error('nama_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Obat <span class="text-danger">*</span></label>
                    <select name="jenis_obat" class="form-select @error('jenis_obat') is-invalid @enderror">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Tablet"  {{ old('jenis_obat') == 'Tablet'  ? 'selected' : '' }}>Tablet</option>
                        <option value="Kapsul"  {{ old('jenis_obat') == 'Kapsul'  ? 'selected' : '' }}>Kapsul</option>
                        <option value="Sirup"   {{ old('jenis_obat') == 'Sirup'   ? 'selected' : '' }}>Sirup</option>
                        <option value="Salep"   {{ old('jenis_obat') == 'Salep'   ? 'selected' : '' }}>Salep</option>
                        <option value="Injeksi" {{ old('jenis_obat') == 'Injeksi' ? 'selected' : '' }}>Injeksi</option>
                        <option value="Tetes"   {{ old('jenis_obat') == 'Tetes'   ? 'selected' : '' }}>Tetes</option>
                        <option value="Lainnya" {{ old('jenis_obat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jenis_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori Obat <span class="text-danger">*</span></label>
                    <select name="kategori_obat" class="form-select @error('kategori_obat') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Obat Keras"  {{ old('kategori_obat') == 'Obat Keras'  ? 'selected' : '' }}>Obat Keras</option>
                        <option value="Obat Bebas"  {{ old('kategori_obat') == 'Obat Bebas'  ? 'selected' : '' }}>Obat Bebas</option>
                        <option value="Narkotika"   {{ old('kategori_obat') == 'Narkotika'   ? 'selected' : '' }}>Narkotika</option>
                        <option value="Psikotropika" {{ old('kategori_obat') == 'Psikotropika' ? 'selected' : '' }}>Psikotropika</option>
                        <option value="Generik"     {{ old('kategori_obat') == 'Generik'     ? 'selected' : '' }}>Generik</option>
                    </select>
                    @error('kategori_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok_obat" min="0"
                           class="form-control @error('stok_obat') is-invalid @enderror"
                           value="{{ old('stok_obat', 0) }}">
                    @error('stok_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok Minimum <span class="text-danger">*</span></label>
                    <input type="number" name="stok_minimum" min="0"
                           class="form-control @error('stok_minimum') is-invalid @enderror"
                           value="{{ old('stok_minimum', 10) }}">
                    @error('stok_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                    <input type="text" name="satuan_obat"
                           class="form-control @error('satuan_obat') is-invalid @enderror"
                           value="{{ old('satuan_obat') }}" placeholder="pcs, botol, strip...">
                    @error('satuan_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Tanggal Kadaluarsa <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_expired"
                           class="form-control @error('tanggal_expired') is-invalid @enderror"
                           value="{{ old('tanggal_expired') }}">
                    @error('tanggal_expired')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
