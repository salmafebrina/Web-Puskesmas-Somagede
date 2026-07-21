@extends('layouts.pendaftaran')

@section('title', 'Cetak Antrian')

@section('page-title', 'Cetak Antrian')

@section('content')

<div class="card shadow-sm">

    <div class="card-header">
        <h4>Cetak Antrian</h4>
    </div>

    <div class="card-body">

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('antrian.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Tanggal Kunjungan
                </label>

                <input
                    type="date"
                    name="tanggal_kunjungan"
                    class="form-control"
                    value="{{ now()->format('Y-m-d') }}"
                    required>
            </div>

            <div class="mb-3">

                <label class="form-label">
                    NIK Pasien
                </label>

                <input
                    type="text"
                    id="nik_pasien"
                    name="nik_pasien"
                    class="form-control"
                    maxlength="16"
                    placeholder="Masukkan NIK"
                    required>
                
                <input type="hidden" id="id_pasien" name="id_pasien">
                <input type="hidden" id="status_registrasi" name="status_registrasi">

                <div id="hasilPencarian" class="list-group mt-1"></div>
            </div>

            <div class="mb-3">

                <label class="form-label">
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Usia
                </label>

                <input
                    type="text"
                    id="usia"
                    class="form-control"
                    readonly>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Status Kondisi
                </label>

                <select
                    id="status_kondisi"
                    name="status_kondisi"
                    class="form-control">

                    <option value="Normal">
                        Normal
                    </option>

                    <option value="Ibu Hamil">
                        Ibu Hamil
                    </option>

                    <option value="Disabilitas">
                        Disabilitas
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Poli Tujuan
                </label>

                <select
                    name="poli_tujuan"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Poli --
                    </option>

                    <option value="Poli Umum">
                        Poli Umum
                    </option>

                    <option value="Poli Gigi">
                        Poli Gigi
                    </option>

                    <option value="Poli KIA">
                        Poli KIA
                    </option>

                    <option value="Poli Lansia">
                        Poli Lansia
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Jenis Jaminan
                </label>

                <select
                    name="jenis_jaminan"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Jaminan --
                    </option>

                    <option value="BPJS">
                        BPJS
                    </option>

                    <option value="Umum">
                        Umum
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Jenis Antrian
                </label>

                <input
                    type="text"
                    id="jenis_antrian_text"
                    class="form-control"
                    readonly>

                <input
                    type="hidden"
                    id="jenis_antrian"
                    name="jenis_antrian">

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Simpan & Cetak Antrian

            </button>

        </form>

    </div>

</div>

<script>

const nik = document.getElementById('nik_pasien');

nik.addEventListener('keyup', function () {

    let keyword = this.value;

    if (keyword.length < 3) {
        document.getElementById('hasilPencarian').innerHTML = '';
        return;
    }

    fetch('/cari-pasien?keyword=' + keyword)
        .then(response => response.json())
        .then(data => {

            let html = '';

            if (data.length === 0) {

                html = `
                    <div class="list-group-item text-muted">
                        Data tidak ditemukan
                    </div>
                `;

            } else {

                data.forEach(function(item){

                    html += `
                    <button
                        type="button"
                        class="list-group-item list-group-item-action pasien-item"
                        data-id="${item.id_pasien}"
                        data-nik="${item.nik_pasien}"
                        data-lahir="${item.tanggal_lahir}"
                        data-status="${item.status_registrasi}">

                        <strong>${item.nik_pasien}</strong><br>
                        ${item.nama_pasien}

                    </button>
                    `;
                });

            }

            document.getElementById('hasilPencarian').innerHTML = html;

        });

});

document.getElementById('hasilPencarian').addEventListener('click', function(e){

    const item = e.target.closest('.pasien-item');

    if(!item) return;

    document.getElementById('nik_pasien').value = item.dataset.nik;
    document.getElementById('id_pasien').value = item.dataset.id;
    document.getElementById('status_registrasi').value = item.dataset.status;
    document.getElementById('tanggal_lahir').value = item.dataset.lahir;

    document.getElementById('hasilPencarian').innerHTML = '';

    hitungUsia();

});

function hitungUsia(){

    let ttl = document
    .getElementById('tanggal_lahir')
    .value;

    if(ttl==""){

        document.getElementById('usia').value='';
        return;

    }

    let lahir = new Date(ttl);
    let sekarang = new Date();

    let tahun =
    sekarang.getFullYear() -
    lahir.getFullYear();

    let bulan =
    sekarang.getMonth() -
    lahir.getMonth();

    let hari =
    sekarang.getDate() -
    lahir.getDate();

    if(hari<0){

        bulan--;
        hari +=30;

    }

    if(bulan<0){

        tahun--;
        bulan +=12;

    }

    document.getElementById('usia').value=
    tahun+' Tahun '+
    bulan+' Bulan '+
    hari+' Hari';

    let kondisi =
    document.getElementById('status_kondisi').value;

    let jenis='Reguler';

    if(
        tahun<2 ||
        tahun>=60 ||
        kondisi!='Normal'
    ){

        jenis='Prioritas';

    }

    document.getElementById('jenis_antrian').value=jenis;
    document.getElementById('jenis_antrian_text').value=jenis;

}

document
.getElementById('tanggal_lahir')
.addEventListener(
'change',
hitungUsia
);

document
.getElementById('status_kondisi')
.addEventListener(
'change',
hitungUsia
);

</script>

@endsection