@extends('layouts.pendaftaran')

@section('title', 'Daftar Kunjungan')

@section('page-title', 'Daftar Kunjungan')

@section('content')

@if(session('success'))

<div class="modal fade show"
     id="pasienModal"
     style="display:block;background:rgba(0,0,0,.5);"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    ✔ Data Berhasil Disimpan

                </h5>
                </div>
            <div class="card shadow-sm mb-4 d-inline-block">

                <div class="card-body">

                    <table class="table table-bordered">

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

            </div>

            <div class="modal-footer">

                <a href="{{ route('kunjungan.create', session('id_antrian')) }}"
                   class="btn btn-success">

                    Daftarkan Kunjungan

                </a>

                <button class="btn btn-secondary"
                        onclick="document.getElementById('pasienModal').style.display='none'">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

@endif


{{-- ================= PRIORITAS ================= --}}

<div class="card shadow-sm mb-4">

    <div class="card-header bg-warning">

        <h5 class="mb-0">

            📌 Daftar Antrian Prioritas

            <span class="badge bg-dark">

                {{ $jumlahPrioritas }}

            </span>

        </h5>

    </div>

    <div class="card-body">

           <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th>No Antrian</th>
                        <th>NIK</th>
                        <th>Poli Tujuan</th>
                        <th>Jaminan</th>
                        <th>Jenis Antrian</th>
                        <th>Status Pasien</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($antrianPrioritas as $antrian)

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
                            <div class="d-flex flex-column gap-1">

    <button
        type="button"
        class="btn btn-primary btn-sm"
        onclick="panggilAntrian('{{ $antrian->kode_antrian }}')">
        <i class="bi bi-volume-up-fill"></i> Panggil
    </button>

    @if($antrian->status_pasien == 'Pasien Lama')

        <a href="{{ route('kunjungan.create',$antrian->id_antrian) }}"
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

</div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Tidak ada antrian prioritas.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ================= REGULER ================= --}}

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            📌 Daftar Antrian Reguler

            <span class="badge bg-light text-dark">

                {{ $jumlahReguler }}

            </span>

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

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

                @forelse($antrianReguler as $antrian)

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
                            <div class="d-flex flex-column gap-1">

                            <button
        type="button"
        class="btn btn-primary btn-sm"
        onclick="panggilAntrian('{{ $antrian->kode_antrian }}')">
        <i class="bi bi-volume-up-fill"></i> Panggil
    </button>

    @if($antrian->status_pasien == 'Pasien Lama')

        <a href="{{ route('kunjungan.create',$antrian->id_antrian) }}"
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
    </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Tidak ada antrian reguler.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

function panggilAntrian(kodeAntrian){

    const text =
        "Nomor antrian " +
        kodeAntrian +
        ", silakan menuju loket pendaftaran.";

    const suara = new SpeechSynthesisUtterance(text);

    suara.lang = "id-ID";

    suara.rate = 0.9;

    speechSynthesis.cancel();

    speechSynthesis.speak(suara);

}

</script>


@endsection