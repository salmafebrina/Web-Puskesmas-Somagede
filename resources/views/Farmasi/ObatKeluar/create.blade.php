@extends('layouts.farmasi')

@section('title','Persiapan Resep')

@section('page-title','Persiapan Resep')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold">
                <i class="bi bi-capsule-pill text-success"></i>
                Persiapan Penyerahan Obat
            </h3>

            <p class="text-muted mb-0">
                Siapkan obat sesuai resep dokter sebelum diserahkan kepada pasien.
            </p>

        </div>

        <a href="{{ route('farmasi.ObatKeluar.index') }}"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

    {{-- Informasi Pasien --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-person-vcard"></i>
                Informasi Pasien
            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Nama Pasien
                    </label>

                    <input
                        class="form-control"
                        readonly
                        value="{{ $resep->pemeriksaan->kunjungan->pasien->nama_pasien }}">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label fw-semibold">
                        Poli
                    </label>

                    <input
                        class="form-control"
                        readonly
                        value="{{ $resep->pemeriksaan->kunjungan->poli_tujuan }}">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label fw-semibold">
                        Dokter
                    </label>

                    <input
                        class="form-control"
                        value= 'jokowi' >

                </div>

                <div class="col-12">

                    <label class="form-label fw-semibold text-danger">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        Riwayat Alergi

                    </label>

                    <textarea
                        class="form-control"
                        rows="2"
                        readonly>{{ $resep->pemeriksaan->kunjungan->pemeriksaanAwal->alergi ?? 'Tidak Ada' }}</textarea>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            <i class="bi bi-capsule"></i>

            Daftar Obat

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered align-middle">

            <thead class="table-light">

                <tr>

                    <th>Nama Obat</th>

                    <th width="100">Jumlah</th>

                    <th>Aturan Pakai</th>

                    <th width="120">Stok</th>

                </tr>

            </thead>

            <tbody>

                @foreach($resep->detailObat as $detail)

                <tr>

                    <td>{{ $detail->obat->nama_obat }}</td>

                    <td>{{ $detail->jumlah }}</td>

                    <td>{{ $detail->aturan_pakai }}</td>

                    <td>

                        <span class="badge bg-success">

                            {{ $detail->obat->stok }}

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-warning">

        <h5 class="mb-0">

            <i class="bi bi-printer"></i>

            Preview Etiket

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            @foreach($resep->detailObat as $detail)

            <div class="col-md-4">

                <div class="card border-dark mb-3">

                    <div class="card-header text-center fw-bold">

                        ETIKET OBAT

                    </div>

                    <div class="card-body">

                        <p>

                            <strong>Pasien</strong><br>

                            {{ $resep->pemeriksaan->kunjungan->pasien->nama_pasien }}

                        </p>

                        <p>

                            <strong>Obat</strong><br>

                            {{ $detail->obat->nama_obat }}

                        </p>

                        <p>

                            <strong>Aturan Pakai</strong><br>

                            {{ $detail->aturan_pakai }}

                        </p>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

<div class="d-flex justify-content-end gap-2">

    <button
        class="btn btn-outline-secondary"
        onclick="window.print()">

        <i class="bi bi-printer"></i>

        Cetak Etiket

    </button>

   <button
    class="btn btn-success"
    data-bs-toggle="modal"
    data-bs-target="#modalSelesai">

    <i class="bi bi-check-circle-fill"></i>

    Selesaikan Proses
    </button>

</div>

<!-- Modal Selesaikan Proses -->
<div class="modal fade"
     id="modalSelesai"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    <i class="bi bi-capsule-pill"></i>

                    Selesaikan Penyerahan Obat

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <i class="bi bi-person-lines-fill display-3 text-primary"></i>

                <h4 class="mt-3">

                    {{ strtoupper($resep->pemeriksaan->kunjungan->pasien->nama_pasien) }}

                </h4>

                <p class="mb-4">

                    Silakan panggil pasien ke loket farmasi
                    untuk mengambil obat.

                </p>

                <button
                    type="button"
                    class="btn btn-primary mb-4">

                    <i class="bi bi-megaphone-fill"></i>

                    Panggil Pasien

                </button>

                <hr>

                <p class="text-muted">

                    Setelah obat diserahkan kepada pasien,
                    klik tombol di bawah ini.

                </p>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Batal

                </button>

                <form method="POST"
                      action="{{ route('farmasi.ObatKeluar.store') }}">

                    @csrf

                    <input
                        type="hidden"
                        name="id_resep"
                        value="{{ $resep->id_resep }}">

                    <button
                        class="btn btn-success">

                        <i class="bi bi-check-circle-fill"></i>

                        Proses Selesai

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</div>

</div>

</div>

</div>

@endsection