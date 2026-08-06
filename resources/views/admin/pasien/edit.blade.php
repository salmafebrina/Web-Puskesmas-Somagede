@extends('layouts.admin')

@section('title', 'Edit Pasien')
@section('page-title', 'Edit Data Pasien')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">
            <i class="fas fa-user-edit me-2 text-primary"></i>
            Edit — {{ $pasien->nama_pasien }}
        </h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.pasien.update', $pasien->id_pasien) }}" method="POST">
            @csrf @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                    <input type="text" name="nik_pasien"
                           class="form-control @error('nik_pasien') is-invalid @enderror"
                           value="{{ old('nik_pasien', $pasien->nik_pasien) }}">
                    @error('nik_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No. BPJS</label>
                    <input type="text" name="id_bpjs"
                           class="form-control"
                           value="{{ old('id_bpjs', $pasien->id_bpjs) }}"
                           placeholder="Kosongkan jika tidak ada">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Pasien <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pasien"
                           class="form-control @error('nama_pasien') is-invalid @enderror"
                           value="{{ old('nama_pasien', $pasien->nama_pasien) }}">
                    @error('nama_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Kepala Keluarga <span class="text-danger">*</span></label>
                    <input type="text" name="nama_kk"
                           class="form-control @error('nama_kk') is-invalid @enderror"
                           value="{{ old('nama_kk', $pasien->nama_kk) }}">
                    @error('nama_kk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir"
                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}">
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor HP <span class="text-danger">*</span></label>
                    <input type="text" name="no_hp"
                           class="form-control @error('no_hp') is-invalid @enderror"
                           value="{{ old('no_hp', $pasien->no_hp) }}">
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat_pasien" rows="2"
                              class="form-control @error('alamat_pasien') is-invalid @enderror">{{ old('alamat_pasien', $pasien->alamat_pasien) }}</textarea>
                    @error('alamat_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
