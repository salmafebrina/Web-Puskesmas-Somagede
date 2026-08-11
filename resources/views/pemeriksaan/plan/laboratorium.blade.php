<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Tanggal</label>

        <input
            type="date"
            name="tanggal"
            class="form-control"
            value="{{ old('tanggal', now()->format('Y-m-d')) }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Nomor RM</label>

        <input
            type="text"
            class="form-control"
            name="nomor_rm"
            value="{{ $kunjungan->pasien->nomor_rm }}"
            readonly>
    </div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Pasien</label>

<input
class="form-control"
name="nama_pasien"
value="{{ $kunjungan->pasien->nama_pasien }}"
readonly>

</div>

<div class="col-md-6 mb-3">

<label>Tanggal Lahir</label>

<input
type="date"
class="form-control"
name="tanggal_lahir"
value="{{ $kunjungan->pasien->tanggal_lahir }}"
readonly>

</div>

</div>

<div class="row">

<div class="col-md-4">

<label>Umur</label>

<input
class="form-control"
value="{{ \Carbon\Carbon::parse($kunjungan->pasien->tanggal_lahir)->age }}"
readonly>

<input
type="hidden"
name="umur"
value="{{ \Carbon\Carbon::parse($kunjungan->pasien->tanggal_lahir)->age }}">

</div>

<div class="col-md-4">

<label>Jenis Kelamin</label>

<input
class="form-control"
value="{{ $kunjungan->pasien->jenis_kelamin=='L' ? 'Laki-laki' : 'Perempuan' }}"
readonly>

<input
type="hidden"
name="jenis_kelamin"
value="{{ $kunjungan->pasien->jenis_kelamin }}">

</div>

<div class="col-md-4">

<label>Jenis Pelayanan</label>

<input
class="form-control"
name="jenis_pelayanan"
value="{{ $kunjungan->poli_tujuan }}"
readonly>

</div>

</div>

<div class="mb-3">

<label>Alamat</label>

<textarea
class="form-control"
rows="2"
readonly>{{ $kunjungan->pasien->alamat_pasien }}</textarea>

<input
type="hidden"
name="alamat"
value="{{ $kunjungan->pasien->alamat_pasien }}">

</div>

<div class="mb-3">

<label>Jenis Pembiayaan</label>

<select
name="jenis_pembiayaan"
class="form-select">

<option value="BPJS">

BPJS

</option>

<option value="Umum">

Umum

</option>

</select>

</div>

<hr>

<h5 class="fw-bold mb-3">

Jenis Pemeriksaan

</h5>

@php
    $groups = $detailLabs->groupBy('kategori_lab');
@endphp

@foreach($groups as $kategori => $items)

<div class="card mb-3">

    <div class="card-header bg-light fw-bold">

        {{ strtoupper($kategori) }}

    </div>

    <div class="card-body">

        <div class="row">

            @foreach($items as $item)

            <div class="col-md-6">

                <div class="form-check mb-2">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="pemeriksaan_lab[]"
                        value="{{ $item->id_laboratorium }}">

                    <label class="form-check-label">

                        {{ $item->jenis_pemeriksaan_lab }}

                    </label>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endforeach