@extends('layouts.admin')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold"><i class="fas fa-user-injured me-2 text-primary"></i>Daftar Pasien</h6>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('admin.pasien.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari berdasarkan NIK atau Nama Pasien..."
                           value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                @if($search)
                <div class="col-md-1">
                    <a href="{{ route('admin.pasien.index') }}" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="4%">No</th>
                        <th>NIK</th>
                        <th>Nama Pasien</th>
                        <th>L/P</th>
                        <th>Tgl Lahir</th>
                        <th>No BPJS</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $i => $pasien)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pasien->nik_pasien }}</td>
                        <td>{{ $pasien->nama_pasien }}</td>
                        <td>
                            <span class="badge {{ $pasien->jenis_kelamin == 'L' ? 'bg-info' : 'bg-pink text-white' }}">
                                {{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ $pasien->id_bpjs ?? '-' }}</td>
                        <td>{{ $pasien->no_hp }}</td>
                        <td>{{ Str::limit($pasien->alamat_pasien, 35) }}</td>
                        <td>
                            <a href="{{ route('admin.pasien.show', $pasien->id_pasien) }}"
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.pasien.edit', $pasien->id_pasien) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pasien.destroy', $pasien->id_pasien) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus pasien {{ $pasien->nama_pasien }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            @if($search)
                                Pasien dengan kata kunci "<strong>{{ $search }}</strong>" tidak ditemukan.
                            @else
                                Belum ada data pasien.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
