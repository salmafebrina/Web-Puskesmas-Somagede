@extends('layouts.pendaftaran')

@section('title', 'Daftar Pasien')

@section('page-title', 'Daftar Pasien')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Pasien</h4>

        <a href="{{ route('pasien.create') }}"
           class="btn btn-success">
            + Tambah Pasien
        </a>
    </div>

    <div class="card-body">

        <!-- Search -->
        <form action="{{ route('pasien.index') }}" method="GET">

            <div class="row mb-3">

                <div class="col-md-10">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari berdasarkan NIK atau Nama Pasien"
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        Cari
                    </button>
                </div>

            </div>

        </form>

        <!-- Table -->
        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>NIK</th>
                        <th>Nama Pasien</th>
                        <th>Nama KK</th>
                        <th>JK</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th width="220">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($pasien as $item)

                    <tr>

                        <td>{{ $item->id_ktp }}</td>
                        <td>{{ $item->nama_pasien }}</td>
                        <td>{{ $item->nama_kk }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat_pasien }}</td>

                        <td>

                            <a href="{{ route('pasien.edit', $item->id_pasien) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('pasien.destroy', $item->id_pasien) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data pasien?')">
                                    Hapus
                                </button>
                            </form>

                            <a href="/rekam-medis/{{ $item->id_pasien }}"
                               class="btn btn-info btn-sm">
                                Riwayat RM
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Data pasien belum tersedia
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection