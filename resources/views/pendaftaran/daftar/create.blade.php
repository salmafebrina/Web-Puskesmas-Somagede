@extends('layouts.pendaftaran')

@section('title','Daftar Kunjungan')

@section('page-title','Daftar Kunjungan')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Form Daftar Kunjungan</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('kunjungan.store') }}" method="POST">

            @csrf

            <input type="hidden"
                   name="id_antrian"
                   value="{{ $antrian->id_antrian }}">

            <input type="hidden"
                   name="jenis_antrian"
                   value="{{ $antrian->jenis_antrian }}">
       

            {{-- ========================= --}}
            {{-- DATA PASIEN --}}
            {{-- ========================= --}}

            <div class="border rounded p-3 mb-4">

                <h5 class="mb-3">Data Pasien</h5>

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text"
                            name="nik_pasien"
                            class="form-control"
                            value="{{ $pasien->nik_pasien }}"
                            readonly>
                    </div>

                <div class="mb-3">
                    <label>No Rekam Medis</label>
                    <input type="text"
                            name="no_rekam_medis"
                            class="form-control"
                            value="{{ $pasien->id_rekam_medis }}"
                            readonly>
                </div>

                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text"
                           name="nama_pasien"
                           class="form-control"
                           value="{{ $pasien->nama_pasien }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Usia</label>
                    @php
                    $tglLahir = \Carbon\Carbon::parse($pasien->tanggal_lahir);
                    $sekarang = \Carbon\Carbon::now();
                    $umur = $tglLahir->diff($sekarang);
                    $umurLengkap = "{$umur->y} Tahun {$umur->m} Bulan {$umur->d} Hari";
                    @endphp
                    <input
                        type="text"
                        name="usia"
                        class="form-control"
                        value="{{ $umurLengkap }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <input type="text"
                           name="jenis_kelamin"
                           class="form-control"
                           value="{{ $pasien->jenis_kelamin }}"
                           readonly>
                </div>

                <button class="btn btn-outline-primary"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#detailPasien">

                    Lihat Detail Pasien

                </button>

                <div class="collapse mt-3" id="detailPasien">

                    <hr>

                    <div class="mb-3">
                        <label>Nama KK</label>
                       <input type="text"
                                name="nama_kk"
                                class="form-control"
                                value="{{ $pasien->nama_kk }}"
                                readonly>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date"
                               name="tanggal_lahir"
                               class="form-control"
                               value="{{ $pasien->tanggal_lahir }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label>No BPJS</label>
                        <input type="text"
                               name="no_bpjs"
                               class="form-control"
                               value="{{ $pasien->id_bpjs }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea class="form-control"
                                  name="alamat"
                                  rows="3"
                                  readonly>{{ $pasien->alamat_pasien }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Desa</label>
                        <input type="text"
                               name="desa"
                               class="form-control"
                               value="{{ $pasien->kode_desa }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label>RT</label>
                        <input type="text"
                               name="rt"
                               class="form-control"
                               value="{{ $pasien->rt }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label>RW</label>
                        <input type="text"
                               name="rw"
                               class="form-control"
                               value="{{ $pasien->rw }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label>No HP</label>
                        <input type="text"
                               name="no_hp"
                               class="form-control"
                               value="{{ $pasien->no_hp }}"
                               readonly>
                    </div>

                </div>

            </div>

            {{-- ========================= --}}
            {{-- INFORMASI KUNJUNGAN --}}
            {{-- ========================= --}}

            <div class="border rounded p-3">

                <h5 class="mb-3">Informasi Kunjungan</h5>

                <div class="mb-3">
                    <label>Tanggal Kunjungan</label>
                    <input type="date"
                           class="form-control"
                           name="tanggal_kunjungan"
                           value="{{ $antrian->tanggal_kunjungan }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Status Pasien</label>

                    <select name="status_pasien"
                            class="form-control">

                        <option value="Pasien Baru"
                            {{ $antrian->status_pasien=='Pasien Baru'?'selected':'' }}>
                            Pasien Baru
                        </option>

                        <option value="Pasien Lama"
                            {{ $antrian->status_pasien=='Pasien Lama'?'selected':'' }}>
                            Pasien Lama
                        </option>

                    </select>

                </div>

                <div class="mb-3">
                    <label>Jenis Jaminan</label>

                    <select name="jenis_jaminan"
                            class="form-control"
                            id="jenisJaminan">

                        <option value="Umum">Umum</option>

                        <option value="BPJS"
                        {{ $pasien->id_bpjs ? 'selected' : '' }}>
                        BPJS
                        </option>

                    </select>

                </div>

                <div class="mb-3">
                    <label>No BPJS</label>

                    <input type="text"
                           name="id_bpjs"
                           class="form-control"
                           value="{{ $pasien->id_bpjs }}">
                </div>

                <div class="mb-3">

                    <label>Poli Tujuan</label>

                    <select name="poli_tujuan"
                            class="form-control">

                        <option>Poli Umum</option>
                        <option>Poli Gigi</option>
                        <option>Poli KIA</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Surat Keterangan</label>

                    <div class="mb-3">
                    <select
                        name="surat_keterangan"
                        id="suratKeterangan"
                        class="form-control">

                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="SKD">SKD (Surat Keterangan Dokter)</option>
                        <option value="Capeng">Capeng (Calon Pengantin)</option>
                        <option value="Lainnya">Lainnya</option>

                    </select>
                    </div>
                    
                  <div class="mb-3" id="keteranganSuratDiv" style="display:none;">
                    <label>Jenis Surat Keterangan</label>
                    <input
                        type="text"
                        name="keterangan_surat"
                        id="keteranganSurat"
                        class="form-control"
                        placeholder="Masukkan jenis surat">
                    </div>

                </div>

                <div class="mb-3">

                    <label>No HP (Opsional)</label>

                    <input type="text"
                           name="no_hp"
                           class="form-control"
                           value="{{ $pasien->no_hp }}">

                </div>

                <div class="mb-3">

                    <label>Deskripsi Alamat (Opsional)</label>

                    <textarea name="deskripsi_alamat"
                              rows="3"
                              class="form-control"
                              placeholder="Contoh : Rumah dekat balai desa"></textarea>

                </div>

                <div class="mb-3">
                    <label>Desa</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $pasien->kode_desa }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>RT</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $pasien->rt }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>RW</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $pasien->rw }}"
                           readonly>
                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                        class="btn btn-success">

                    Simpan Kunjungan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection

<script>

document.addEventListener("DOMContentLoaded", function () {

    const surat = document.getElementById("suratKeterangan");
    const divKeterangan = document.getElementById("keteranganSuratDiv");
    const inputKeterangan = document.getElementById("keteranganSurat");

    surat.addEventListener("change", function () {

        if (this.value === "Lainnya") {

            divKeterangan.style.display = "block";

            inputKeterangan.setAttribute("required", true);

        } else {

            divKeterangan.style.display = "none";

            inputKeterangan.removeAttribute("required");

            inputKeterangan.value = "";

        }

    });

});

</script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    document.getElementById('suratKeterangan')
        .addEventListener('change', function(){

        document.getElementById('keteranganSurat')
            .style.display =
            this.value=='Lainnya'
            ? 'block'
            : 'none';

    });

});

</script>