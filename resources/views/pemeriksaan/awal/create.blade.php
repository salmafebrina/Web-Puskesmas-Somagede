@extends('layouts.pemeriksaan')

@section('title','Pemeriksaan Awal')

@section('page-title','Pemeriksaan Awal')

@section('content')

<form action="{{ route('pemeriksaan.awal.store') }}" method="POST">

    @csrf

    <input
        type="hidden"
        name="id_kunjungan"
        value="{{ $kunjungan->id_kunjungan }}">

    <input
        type="hidden"
        name="jenis_antrian"
        value="{{ $kunjungan->jenis_antrian }}">

{{-- Header --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Pemeriksaan Awal
        </h3>

        <input
        type="hidden"
        name="id_kunjungan"
        value="{{ $kunjungan->id_kunjungan }}">
            <div class="text-muted">
            {{ $kunjungan->nama_pasien }}
            <span class="mx-2">•</span>
            RM {{ $kunjungan->no_rekam_medis }}
        </div>

    </div>

    <a
        href="{{ route('pemeriksaan.awal.index') }}"
        class="btn btn-outline-secondary">

        <i class="fas fa-arrow-left me-1"></i>

        Kembali

    </a>

</div>

                <div class="accordion mb-4" id="accordionPasien">

    <div class="accordion-item">

        <h2 class="accordion-header">

            <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#detailPasien">

                <i class="fas fa-user me-2"></i>

                Detail Pasien

            </button>

        </h2>

        <div
            id="detailPasien"
            
            class="accordion-collapse collapse"
            data-bs-parent="#accordionPasien">

            <div class="accordion-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">No Rekam Medis</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->no_rekam_medis }}"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">NIK</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->nik_pasien }}"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Nama Pasien</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->nama_pasien }}"
                            readonly>

                    </div>

                        <div class="col-md-6 mb-3">

                        <label class="form-label">Nama KK</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->nama_kk ?? '-' }}"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Jenis Kelamin</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->jenis_kelamin ?? '-' }}"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Tanggal Lahir</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->tanggal_lahir ?? '-' }}"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">No. HP</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->no_hp ?? '-' }}"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">BPJS</label>

                        <input
                            class="form-control"
                            value="{{ $kunjungan->no_bpjs ?? '-' }}"
                            readonly>

                    </div>

                    <div class="col-12">

                        <label class="form-label">Alamat</label>

                        <textarea
                            class="form-control"
                            rows="2"
                            readonly>{{ $kunjungan->alamat_pasien ?? '-' }}</textarea>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="fas fa-clipboard-list text-primary me-2"></i>

            Informasi Kunjungan

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Tanggal Kunjungan
                </label>

                <input
                    class="form-control"
                    value="{{ $kunjungan->tanggal_kunjungan }}"
                    readonly>

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Poli Tujuan
                </label>

                <input
                    class="form-control"
                    value="{{ $kunjungan->poli_tujuan }}"
                    readonly>

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Jenis Penjamin
                </label>

                <input
                    class="form-control"
                    value="{{ $kunjungan->jenis_jaminan }}"
                    readonly>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            <i class="fas fa-notes-medical text-danger me-2"></i>
            Triase
        </h5>

    </div>

    <div class="card-body">

        <div class="d-flex gap-4">

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="triase"
                       value="Hijau">

                <label class="form-check-label">
                    🟢 Hijau
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="triase"
                       value="Kuning">

                <label class="form-check-label">
                    🟡 Kuning
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="triase"
                       value="Merah">

                <label class="form-check-label">
                    🔴 Merah
                </label>
            </div>

        </div>

    </div>

</div>
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            <i class="fas fa-person-falling text-warning me-2"></i>
            Risiko Jatuh
        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="risiko_jatuh"
                        value="Tidak Berisiko">

                    <label class="form-check-label">

                        Tidak Berisiko

                    </label>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="risiko_jatuh"
                        value="Risiko Rendah">

                    <label class="form-check-label">

                        Risiko Rendah

                    </label>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="risiko_jatuh"
                        value="Risiko Tinggi">

                    <label class="form-check-label">

                        Risiko Tinggi

                    </label>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- KONDISI KHUSUS + ALERGI --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            <i class="fas fa-heartbeat text-success me-2"></i>
            Kondisi Khusus
        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <label class="form-label">

                    Kondisi

                </label>

                <select
                    name="kondisi_khusus"
                    class="form-select">

                    <option value="Tidak Ada">Tidak Ada</option>

                    <option value="Hamil">Hamil</option>

                    <option value="Menyusui">Menyusui</option>

                </select>

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Riwayat Alergi

                </label>

                <textarea
                    rows="2"
                    class="form-control"
                    name="alergi"></textarea>

            </div>

        </div>

    </div>

</div>

{{-- KONDISI KHUSUS + ALERGI --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="fas fa-ruler text-primary me-2"></i>

            Antropometri & Tanda Vital

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Berat Badan (Kg)
                </label>

                <input
                    type="number"
                    step="0.1"
                    name="berat_badan"
                    class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Tinggi Badan (Cm)
                </label>

                <input
                    type="number"
                    name="tinggi_badan"
                    class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Lingkar Perut (Cm)
                </label>

                <input
                    type="number"
                    name="lingkar_perut"
                    class="form-control">

            </div>

        </div>

    </div>

</div>

{{-- SOAP --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="fas fa-file-medical text-primary me-2"></i>

            SUBJEKTIF

        </h5>

    </div>

    <div class="card-body">

        <div class="mb-3">
            <textarea
                name="keluhan"
                rows="3"
                class="form-control"
                placeholder="Tuliskan keluhan utama pasien..."></textarea>

        </div>
    </div>
</div>

{{--OBJECTIVE--}}
        <div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="fas fa-file-medical text-primary me-2"></i>

            OBJECTIVE

        </h5>

    </div>
        <div class="mb-3">

            <label class="form-label fw-semibold">

                Objektif (O)

            </label>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Tekanan Darah
                </label>

                <input
                    type="text"
                    name="tekanan_darah"
                    class="form-control"
                    placeholder="120/80">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Suhu Tubuh (°C)
                </label>

                <input
                    type="number"
                    step="0.1"
                    name="suhu"
                    class="form-control">

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Nadi
                </label>

                <input
                    type="number"
                    name="nadi"
                    class="form-control">

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Respirasi
                </label>

                <input
                    type="number"
                    name="respirasi"
                    class="form-control">

            </div>

            <textarea
                name="objektif"
                rows="3"
                class="form-control"
                placeholder="Hasil observasi pemeriksaan awal..."></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label fw-semibold">

            DIAGNOSA KEPERWATAN/KEBIDANAN

            </label>

            <textarea
                name="assessment"
                rows="3"
                class="form-control"
                placeholder="Kesimpulan atau penilaian awal..."></textarea>


   <button type="submit" class="btn btn-primary">
    Simpan dan Kirim
    </button>


</div>

    </div>

</div>
    <div class="d-flex justify-content-end gap-2 mb-4"> 
                </div>
     </form>

</div>

@endsection