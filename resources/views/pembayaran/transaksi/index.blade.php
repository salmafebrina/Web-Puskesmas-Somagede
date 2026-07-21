@extends('layouts.pembayaran')

@section('title', 'Daftar Kunjungan')

@section('page-title', 'Daftar Kunjungan')

@section('content')

@if(session('success'))

<div
    class="modal fade show"
    id="pasienModal"
    style="display:block; background:rgba(0,0,0,.5);"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                    Data Pasien Berhasil Ditambahkan
                </h5>

            </div>

            <div class="modal-body">

                <table class="table">

                    <tr>

                        <th>Nama Pasien</th>

                        <td>{{ session('nama_pasien') }}</td>

                    </tr>

                    <tr>

                        <th>NIK</th>

                        <td>{{ session('nik_pasien') }}</td>

                    </tr>

                    <tr>

                        <th>No RM</th>

                        <td>{{ session('no_rm') }}</td>

                    </tr>

                </table>

            </div>

            <div class="modal-footer">

                <a
                    href="{{ route('kunjungan.create', session('id_antrian')) }}"
                    class="btn btn-success">

                    Daftarkan Kunjungan

                </a>

                <button
                    class="btn btn-secondary"
                    onclick="document.getElementById('pasienModal').style.display='none'">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

@endif

<div class="card">

    <div class="card-header">
        <h4>Daftar Antrian Kunjungan</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>No Antrian</th>
                    <th>NIK</th>
                    <th>Poli Tujuan</th>
                    <th>Jaminan</th>
                    <th>Jenis Antrian</th>
                    <th>Status Pasien</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($antrians as $antrian)

                <tr>

                    <td>{{ $antrian->kode_antrian }}</td>

                    <td>{{ $antrian->nik_pasien }}</td>

                    <td>{{ $antrian->poli_tujuan }}</td>

                    <td>{{ $antrian->jenis_jaminan }}</td>

                    <td>{{ $antrian->jenis_antrian }}</td>

                    <td>

                        @if($antrian->status_pasien == 'Pasien Lama')

                            <span class="badge bg-success">
                                Pasien Lama
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Pasien Baru
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($antrian->status_pasien == 'Pasien Lama')

                            <a href="{{ route('kunjungan.create', $antrian->id_antrian) }}"
                               class="btn btn-success btn-sm">

                                Daftarkan Kunjungan

                            </a>

                        @else

                            <a href="{{ route('pasien.create',[
                                    'nik'=>$antrian->nik_pasien,
                                    'id_antrian'=>$antrian->id_antrian
                                ]) }}"
                               class="btn btn-warning btn-sm">

                                Simpan Data Pasien

                            </a>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada data antrian.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection