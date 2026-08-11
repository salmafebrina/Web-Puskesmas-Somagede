@extends('layouts.pemeriksaan')

@section('title','Pemeriksaan Poli')
@section('page-title','Pemeriksaan Poli')
@section('content')

<form
    id="formPemeriksaan"
    action="{{ route('pemeriksaan.poli.store') }}"
    method="POST">
    
    @csrf
<input
    type="hidden"
    name="id_kunjungan"
    value="{{ $kunjungan->id_kunjungan }}">

<input
    type="hidden"
    name="id_pemeriksaan"
    value="{{ $kunjungan->pemeriksaan->id_pemeriksaan }}">
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-clipboard2-pulse-fill text-primary"></i>
                Pemeriksaan Poli
            </h3>
            <p class="text-muted mb-0">
                Form Pemeriksaan Dokter
            </p>
        </div>

        <a href="{{ route('pemeriksaan.poli.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- informasi pasien --}}
    <div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">
            <i class="bi bi-person-vcard-fill"></i>
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
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->pasien->nama_pasien }}"
                    readonly>
            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-semibold">
                    Usia
                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->pasien->umur }} Tahun"
                    readonly>

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-semibold">
                    Poli
                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->poli_tujuan }}"
                    readonly>

            </div>

            <div class="col-md-12 mb-3">

                <label class="form-label fw-semibold">
                    Alamat
                </label>

                <textarea
                    class="form-control"
                    rows="2"
                    readonly>{{ $kunjungan->pasien->alamat_pasien }}</textarea>

            </div>

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Kondisi Khusus
                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->pemeriksaanAwal->kondisi_khusus ?? '-' }}"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Alergi
                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kunjungan->pemeriksaanAwal->alergi ?? '-' }}"
                    readonly>

            </div>

        </div>

    </div>

</div>

{{--Hasil Pemeriksaan Awal--}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-clipboard2-heart-fill"></i>
            Ringkasan Pemeriksaan Awal
        </h5>

        <button
            class="btn btn-light btn-sm"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#ringkasanAwal">

            <i class="bi bi-eye"></i>
            Tampilkan

        </button>

    </div>

    <div class="collapse" id="ringkasanAwal">

        <div class="card-body">

            <div class="row">

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Berat Badan</label>
        <input
            type="text"
            class="form-control"
            value="{{ $kunjungan->pemeriksaan->berat_badan ?? '-' }} Kg"
            readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Tinggi Badan</label>
        <input
            type="text"
            class="form-control"
            value="{{ $kunjungan->pemeriksaan->tinggi_badan ?? '-' }} Cm"
            readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Tekanan Darah</label>
        <input
            type="text"
            class="form-control"
            value="{{ $kunjungan->pemeriksaan->tekanan_darah ?? '-' }}"
            readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Suhu</label>
        <input
            type="text"
            class="form-control"
            value="{{ $kunjungan->pemeriksaan->suhu ?? '-' }} °C"
            readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Nadi</label>
        <input
            type="text"
            class="form-control"
            value="{{ $kunjungan->pemeriksaan->nadi ?? '-' }} x/menit"
            readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Respirasi</label>
        <input
            type="text"
            class="form-control"
            value="{{ $kunjungan->pemeriksaan->respirasi ?? '-' }} x/menit"
            readonly>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Keluhan Utama</label>
        <textarea
            class="form-control"
            rows="3"
            readonly>{{ $kunjungan->pemeriksaan->keluhan ?? '-' }}</textarea>
    </div>

        </div>
        </div>
</div>
</div>


{{-- Card Pemeriksaan Dokter --}}
<div class="card shadow-sm border-0 mb-4">
<div class="card-header bg-warning d-flex justify-content-between align-items-center">

    <h5 class="mb-0 fw-bold">
        <i class="bi bi-stethoscope"></i>
        Pemeriksaan Dokter
    </h5>

    <button
        class="btn btn-light btn-sm"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#cardDokter">

        <i class="bi bi-eye"></i>
        Tampilkan

    </button>

</div>

<div class="collapse" id="cardDokter">
    <div class="card-body">
        {{-- Objective --}}
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Objective
            </label>

            <textarea
                name="objektif"
                class="form-control @error('objektif') is-invalid @enderror"
                rows="4"
                placeholder="Masukkan hasil pemeriksaan objektif...">{{ old('objektif', $kunjungan->pemeriksaan->objektif ?? '') }}</textarea>

            @error('objektif')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="row">

            {{-- Retraksi --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">
                    Retraksi
                </label>

                <select
                    name="retraksi"
                    class="form-select">

                    <option value="">-- Pilih --</option>

                    <option value="Ada">
                        Ada
                    </option>

                    <option value="Tidak Ada">
                        Tidak Ada
                    </option>

                </select>

            </div>

            {{-- Stridor --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">
                    Stridor
                </label>

                <select
                    name="stridor"
                    class="form-select">

                    <option value="">-- Pilih --</option>

                    <option value="Ada">
                        Ada
                    </option>

                    <option value="Tidak Ada">
                        Tidak Ada
                    </option>

                </select>

            </div>

            {{-- Skala Nyeri --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">
                    Skala Nyeri
                </label>

                <select
                    name="skala_nyeri"
                    class="form-select">

                    <option value="">-- Pilih --</option>

                    <option value="0">0 - Tidak Nyeri</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3 - Ringan</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6 - Sedang</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10 - Nyeri Berat</option>

                </select>

            </div>

        </div>

        {{-- Assessment --}}
        <div class="mt-3">

            <label class="form-label fw-semibold">
                Assessment
            </label>

            <textarea
                name="assessment"
                class="form-control @error('assessment') is-invalid @enderror"
                rows="4"
                placeholder="Masukkan assessment dokter...">{{ old('assessment', $kunjungan->pemeriksaan->assessment ?? '') }}</textarea>

            @error('assessment')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

</div>
</div>

{{-- Diagnosa dan ICD-10 --}}
<div class="card shadow-sm border-0 mb-4">
<div class="card-header bg-warning d-flex justify-content-between align-items-center">

    <h5 class="mb-0 fw-bold">
        <i class="bi bi-stethoscope"></i>
        ICD-10 & Diagnosa
    </h5>

    <button
        class="btn btn-light btn-sm"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#cardDiagnosa">

        <i class="bi bi-eye"></i>
        Tampilkan

    </button>

</div>

<div class="collapse" id="cardDiagnosa">
    <div class="card-body">
        <div class="mb-3">

    <label class="form-label fw-semibold">
        ICD-10
    </label>

    <select
        name="kode_icd10"
        id="kode_icd10"
        class="form-select">

        @if(!empty($kunjungan->pemeriksaan->kode_icd10))
            <option selected>
                {{ $kunjungan->pemeriksaan->kode_icd10 }}
            </option>
        @endif
    </select>
        <div class="mb-3">

            <label class="form-label fw-semibold">
                Nama Penyakit
            </label>

            <input
                type="text"
                id="nama_penyakit"
                class="form-control"
                readonly>
        </div>

</div>
        </div>

        <div>
            <label class="form-label fw-semibold">
                Diagnosa
            </label>

            <textarea
                name="diagnosa"
                rows="3"
                class="form-control"
                placeholder="Masukkan diagnosa dokter...">{{ old('diagnosa', $kunjungan->pemeriksaan->diagnosa ?? '') }}</textarea>
        </div>

    </div>

</div>
</div>

{{-- Tindakan --}}
<div class="card shadow-sm border-0 mb-4">
<div class="card-header d-flex justify-content-between align-items-center">

    <h5 class="mb-0 fw-bold">
        <i class="bi bi-stethoscope"></i>
        Tindakan
    </h5>

    <button
        class="btn btn-light btn-sm"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#cardTindakan">

        <i class="bi bi-eye"></i>
        Tampilkan

    </button>

</div>

<div class="collapse" id="cardTindakan">
    <div class="d-flex justify-content-between align-items-center mb-3">

    <p class="text-muted mb-0">
        Pilih tindakan pelayanan yang dilakukan dokter.
    </p>

    <button
        type="button"
        class="btn btn-primary btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#modalTindakan">

        <i class="bi bi-plus-circle"></i>
        Tambah Tindakan

    </button>

</div>

<table class="table table-bordered align-middle">

    <thead class="table-light">

        <tr>

            <th width="60">No</th>

            <th>Nama Tindakan</th>

            <th width="80">Aksi</th>

        </tr>

    </thead>

    <tbody id="listTindakan">

        <tr id="emptyRow">

            <td colspan="3"
                class="text-center text-muted">

                Belum ada tindakan dipilih.

            </td>

        </tr>

    </tbody>

    </table>
    </div>
</div>

{{-- KIE (Komunikasi, Informasi, Edukasi) --}}
<div class="card shadow-sm border-0 mb-4">
<div class="card-header bg-warning d-flex justify-content-between align-items-center">

    <h5 class="mb-0 fw-bold">
        <i class="bi bi-stethoscope"></i>
        KIE (Komunikasi, Informasi, Edukasi)
    </h5>

    <button
        class="btn btn-light btn-sm"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#cardKIE">

        <i class="bi bi-eye"></i>
        Tampilkan

    </button>

</div>

<div class="collapse" id="cardKIE">
    <div class="card-body">

        <textarea
            name="kie"
            rows="4"
            class="form-control"
            placeholder="Masukkan edukasi yang diberikan kepada pasien..."></textarea>

    </div>

</div>
</div>

<!-- Plan -->
<div class="card shadow-sm border-0 mb-4">
<div class="card-header d-flex justify-content-between align-items-center">

    <h5 class="mb-0 fw-bold">
        <i class="bi bi-stethoscope"></i>
        Plan
    </h5>

    <button
        class="btn btn-light btn-sm"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#cardPlan">

        <i class="bi bi-eye"></i>
        Tampilkan

    </button>

</div>

<div class="collapse" id="cardPlan">
    <div class="card-body">

        <div class="row">

            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="plan[]" value="Resep">
                    <label class="form-check-label">Resep Obat</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="plan[]" value="Laboratorium">
                    <label class="form-check-label">Laboratorium</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="plan[]" value="Rujukan">
                    <label class="form-check-label">Rujukan</label>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="plan[]" value="Kontrol">
                    <label class="form-check-label">Kontrol</label>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="plan[]" value="Edukasi">
                    <label class="form-check-label">Edukasi</label>
                </div>
            </div>

        </div>

    </div>

</div>
</div>

{{-- TTD --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">
            <i class="bi bi-person-badge-fill"></i>
            Dokter Pemeriksa
        </h5>
    </div>

    <div class="card-body">

        <input
            type="text"
            class="form-control"
            value="{{ Auth::check() ? Auth::user()->name_user : '' }}"
            readonly>

    </div>

</div>
{{-- Submit Button --}}
<div class="d-flex justify-content-end gap-2 mb-5">

    <a href="{{ route('pemeriksaan.poli.index') }}"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>
        Kembali

    </a>

    <button
    type="button"
    id="btnOpenWizard"
    class="btn btn-primary">

    Simpan Pemeriksaan
    </button>
   

</div>
</div>

    </div>

</div>

</div>
<div class="modal fade"
    id="modalTindakan"
    tabindex="-1">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

Tambah Tindakan

</h5>

<button
class="btn-close"
data-bs-dismiss="modal">

</button>

</div>

<div class="modal-body">

<input
type="text"
id="searchTindakan"
class="form-control mb-3"
placeholder="Cari tindakan...">

<table class="table table-hover">

<thead class="table-light">
    <tr>
        <th>Sub Kategori</th>
        <th>Jenis Tindakan</th>
        <th width="70">Aksi</th>
    </tr>
</thead>

<tbody id="hasilTindakan">

@foreach($tarifs as $tarif)

<tr>

    <td>{{ $tarif->sub_kategori }}</td>

    <td>{{ $tarif->jenis_tindakan }}</td>

    <td class="text-center">

        <button
            type="button"
            class="btn btn-success btn-sm pilihTindakan"
            data-id="{{ $tarif->id_tarif }}"
            data-nama="{{ $tarif->jenis_tindakan }}">

            <i class="bi bi-plus"></i>

        </button>

    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>
<script>

document.getElementById('searchTindakan').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();

    let rows = document.querySelectorAll('#hasilTindakan tr');

    rows.forEach(function(row){

        let text = row.innerText.toLowerCase();

        row.style.display = text.includes(keyword) ? '' : 'none';

    });

});

let nomor = 1;

document.querySelectorAll('.pilihTindakan').forEach(function(btn){

    btn.addEventListener('click', function(){

        let id = this.dataset.id;
        let nama = this.dataset.nama;

         if(document.querySelector('input[value="'+id+'"]')){

    alert("Tindakan sudah dipilih.");

    return;}

        document.getElementById('emptyRow')?.remove();

        let tbody = document.getElementById('listTindakan');

        tbody.insertAdjacentHTML('beforeend',`

        <tr>

            <td>${nomor++}</td>

            <td>

                ${nama}

                <input
                    type="hidden"
                    name="tindakan[]"
                    value="${id}">

            </td>

            <td>

                <button
                    type="button"
                    class="btn btn-danger btn-sm hapus">

                    ×

                </button>

            </td>

        </tr>

        `);

    });

});
document.addEventListener('click',function(e){

   const btn = e.target.closest('.hapus');
    if(btn){ btn.closest('tr').remove();}
    });
</script>

@include('pemeriksaan.plan.wizard')
</form>
@endsection