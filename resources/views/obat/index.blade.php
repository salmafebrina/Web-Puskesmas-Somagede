@extends('layouts.app')

@section('title', 'Data Obat')

@section('page-title', 'Data Obat')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">
    Tambah Obat
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Stok Minimum</th>
            <th>Satuan</th>
            <th>Expired</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($obats as $index => $obat)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $obat->nama_obat }}</td>
            <td>{{ $obat->jenis_obat }}</td>
            <td>{{ $obat->kategori_obat }}</td>
            <td>{{ $obat->stok_obat }}</td>
            <td>{{ $obat->stok_minimum }}</td>
            <td>{{ $obat->satuan_obat }}</td>
            <td>{{ $obat->tanggal_expired }}</td>

            @foreach($obats as $index => $obat)
            <td>
                <a href="{{ route('obat.edit', $obat->id_obat) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('obat.destroy', $obat->id_obat) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center">
                Belum ada data obat
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection