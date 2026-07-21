@extends('layouts.pendaftaran')

@section('title', 'Data Pasien')

@section('page-title', 'Data Pasien')

@section('content')

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow-sm">

<div class="card-header d-flex justify-content-between align-items-center">

    <h4 class="mb-0">Daftar Pasien</h4>

</div>

<div class="card-body">

    <form method="GET" action="{{ route('pasien.index') }}">

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

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th width=5%>No</th>
                    <th>NIK</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama KK</th>
                    <th>Tanggal Lahir</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pasiens as $index => $pasien)

                <tr>

                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pasien->nik_pasien }}</td>
                    <td>{{ $pasien->nama_pasien }}</td>
                    <td>{{ $pasien->jenis_kelamin }}</td>
                    <td>{{ $pasien->nama_kk }}</td>
                    <td>{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->alamat_pasien }}</td>

                    <td>

                        <a href="#"
                        class="btn btn-info btn-sm">
                            Riwayat RM
                        </a>

                        <a href="{{ route('pasien.edit', $pasien->id_pasien) }}"
                        class="btn btn-warning btn-sm">
                            Edit
                        </a>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="9" class="text-center">
                        Data pasien belum tersedia.
                    </td>
                </tr>

                @endforelse

                </tbody>

        </table>

    </div>

</div>

</div>

@endsection

@if(session('success'))

<div
    class="modal fade"
    id="successModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    ✔ Data Berhasil Disimpan

                </h5>

            </div>

            <div class="modal-body">

                <p>

                    Data pasien berhasil ditambahkan.

                </p>

                <hr>

                <table class="table table-borderless">

                    <tr>

                        <th>No RM</th>

                        <td>{{ $pasien->id_pasien }}</td>

                    </tr>

                    <tr>

                        <th>Nama</th>

                        <td>{{ $pasien->nama_pasien }}</td>

                    </tr>

                    <tr>

                        <th>NIK</th>

                        <td>{{ $pasien->id_ktp }}</td>

                    </tr>

                </table>

                <div class="alert alert-info">

                    Silakan lanjutkan proses
                    <b>Daftarkan Kunjungan.</b>

                </div>

            </div>

            <div class="modal-footer">

                <a
                    href="{{ route('kunjungan.create',$pasien->id_pasien) }}"
                    class="btn btn-success">

                    Daftarkan Kunjungan

                </a>

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

@endif

@if(session('success'))

<script>

document.addEventListener(
'DOMContentLoaded',

function(){

new bootstrap.Modal(
document.getElementById('successModal')
).show();

});

</script>

@endif
