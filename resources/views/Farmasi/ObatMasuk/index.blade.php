@extends('layouts.farmasi')

@section('title','Obat Masuk')

@section('page-title','Obat Masuk')

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h4>Daftar Obat Masuk</h4>

        <a
            href="{{ route('obat-masuk.create') }}"
            class="btn btn-primary">

            + Tambah Obat Masuk

        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead class="table-primary">

                <tr>

                    <th>No</th>

                    <th>Tanggal Masuk</th>

                    <th>Nama Obat</th>

                    <th>Jumlah</th>

                    <th>Keterangan</th>

                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($obatMasuks as $index => $obatMasuk)

                <tr>

                    <td>{{ $index + 1 }}</td>

                    <td>

                        {{ \Carbon\Carbon::parse($obatMasuk->tanggal_masuk)->format('d-m-Y') }}

                    </td>

                    <td>

                        {{ $obatMasuk->obat->nama_obat }}

                    </td>

                    <td>

                        {{ $obatMasuk->jumlah_masuk }}

                    </td>

                    <td>

                        {{ $obatMasuk->keterangan }}

                    </td>

                    <td>

                        <a
                            href="{{ route('obat-masuk.edit',$obatMasuk->id_obat) }}"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('obat-masuk.destroy',$obatMasuk->id_obat_masuk) }}"
                            method="POST"
                            class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data ini?')">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Belum ada data obat masuk.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection