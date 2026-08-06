@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold"><i class="fas fa-user-edit me-2 text-primary"></i>Edit Data User</h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email / Username <span class="text-danger">*</span></label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror">
                    <option value="admin"       {{ old('role', $user->role) == 'admin'       ? 'selected' : '' }}>Admin</option>
                    <option value="pendaftaran" {{ old('role', $user->role) == 'pendaftaran' ? 'selected' : '' }}>Petugas Pendaftaran</option>
                    <option value="pemeriksaan" {{ old('role', $user->role) == 'pemeriksaan' ? 'selected' : '' }}>Petugas Pemeriksaan</option>
                    <option value="pembayaran"  {{ old('role', $user->role) == 'pembayaran'  ? 'selected' : '' }}>Petugas Kasir</option>
                    <option value="farmasi"     {{ old('role', $user->role) == 'farmasi'     ? 'selected' : '' }}>Petugas Farmasi</option>
                </select>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr>
            <p class="text-muted small mb-3">Kosongkan kolom password jika tidak ingin mengubah password.</p>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Minimal 6 karakter">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password baru">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
