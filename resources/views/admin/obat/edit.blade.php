@extends('layouts.admin')

@section('title', 'Edit Obat')
@section('page-title', 'Edit Data Obat')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">
            <i class="fas fa-edit me-2 text-primary"></i>Edit — {{ $obat->nama_obat }}
        </h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.obat.update', $obat->id_obat) }}" method="POST">
            @csrf @method('PUT')

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat"
                           class="form-control @error('nama_obat') is-invalid @enderror"
                           value="{{ old('nama_obat', $obat->nama_obat) }}">
                    @error('nama_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Obat <span class="text-danger">*</span></label>
                    <select name="jenis_obat" class="form-select @error('jenis_obat') is-invalid @enderror">
                        @foreach(['Tablet','Kapsul','Sirup','Salep','Injeksi','Tetes','Lainnya'] as $j)
                        <option value="{{ $j }}" {{ old('jenis_obat', $obat->jenis_obat) == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jenis_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori Obat <span class="text-danger">*</span></label>
                    <select name="kategori_obat" class="form-select @error('kategori_obat') is-invalid @enderror">
                        @foreach(['Obat Keras','Obat Bebas','Narkotika','Psikotropika','Generik'] as $k)
                        <option value="{{ $k }}" {{ old('kategori_obat', $obat->kategori_obat) == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                    @error('kategori_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok_obat" min="0"
                           class="form-control @error('stok_obat') is-invalid @enderror"
                           value="{{ old('stok_obat', $obat->stok_obat) }}">
                    @error('stok_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok Minimum <span class="text-danger">*</span></label>
                    <input type="number" name="stok_minimum" min="0"
                           class="form-control @error('stok_minimum') is-invalid @enderror"
                           value="{{ old('stok_minimum', $obat->stok_minimum) }}">
                    @error('stok_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                    <input type="text" name="satuan_obat"
                           class="form-control @error('satuan_obat') is-invalid @enderror"
                           value="{{ old('satuan_obat', $obat->satuan_obat) }}">
                    @error('satuan_obat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Tanggal Kadaluarsa <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_expired"
                           class="form-control @error('tanggal_expired') is-invalid @enderror"
                           value="{{ old('tanggal_expired', $obat->tanggal_expired) }}">
                    @error('tanggal_expired')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
