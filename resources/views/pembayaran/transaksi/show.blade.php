@extends('layouts.pembayaran')

@section('title','Detail Pembayaran')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('pembayaran.store', $kunjungan->id_kunjungan) }}" method="POST">
    @csrf

    <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id_kunjungan }}">

    <input type="hidden" name="jenis_jaminan" id="jenis_jaminan" value="{{ $kunjungan->jenis_jaminan }}" readonly>
<div class="container">

    <div class="card">

        <div class="card-header">
            Detail Pembayaran
        </div>

        <h5 class="mb-3">
    Informasi Pasien
</h5>

<table class="table table-borderless">

<tr>
    <th width="220">Nama Pasien</th>
    <td>{{ $kunjungan->pasien->nama_pasien }}</td>
</tr>

<tr>
    <th>Alamat</th>
    <td>{{ $kunjungan->pasien->alamat_pasien }}</td>
</tr>

<tr>
    <th>Tanggal Pemeriksaan</th>
    <td>
        {{ \Carbon\Carbon::parse($kunjungan->created_at)->format('d-m-Y') }}
    </td>
</tr>

</table>

            
         <div class="card mt-4">

    <div class="card-header bg-primary text-white">

        <strong>Pemeriksaan Klinis</strong>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th width="70%">Nama Tindakan</th>

                    <th class="text-end">Tarif</th>

                </tr>

            </thead>

            <tbody>

            @forelse($detailTindakan as $item)

                <tr>

                    <td>

                        {{ $item['nama'] }}

                    </td>

                    <td class="text-end">

                        Rp {{ number_format($item['tarif'],0,',','.') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" class="text-center">

                        Tidak ada tindakan.

                    </td>

                </tr>

            @endforelse

            <tr class="table-warning">

                <th>Subtotal Pemeriksaan Klinis</th>

                <th class="text-end">

                    Rp {{ number_format($totalTindakan,0,',','.') }}

                </th>

            </tr>

            </tbody>

        </table>

    </div>

</div>
<div class="card mt-4">

    <div class="card-header bg-info text-white">

        <strong>Pemeriksaan Penunjang</strong>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>Nama Pemeriksaan</th>

                <th width="180" class="text-end">

                    Tarif

                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($detailPenunjang as $item)

                <tr>

                    <td>

                        {{ $item['nama'] }}

                    </td>

                    <td class="text-end">

                        Rp {{ number_format($item['tarif'],0,',','.') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" class="text-center">

                        Tidak ada pemeriksaan penunjang.

                    </td>

                </tr>

            @endforelse

            <tr class="table-warning">

                <th>Subtotal</th>

                <th class="text-end">

                    Rp {{ number_format($totalPenunjang,0,',','.') }}

                </th>

            </tr>

            </tbody>

        </table>

    </div>

</div>

<div class="card mt-3">

    <div class="card-header">

        <strong>Obat-obatan</strong>

    </div>

    <div class="card-body">

        <table class="table">

            <thead>

            <tr>

                <th>Nama Obat</th>

                <th>Jumlah</th>

                <th>Harga</th>

                <th>Subtotal</th>

            </tr>

            </thead>

            <tbody>

            @forelse($detailObat as $item)

                <tr>

                    <td>{{ $item['nama'] }}</td>

                    <td>{{ $item['jumlah'] }}</td>

                    <td>Rp {{ number_format($item['harga']) }}</td>

                    <td>Rp {{ number_format($item['subtotal']) }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">

                        Tidak ada obat.

                    </td>

                </tr>

            @endforelse

            <tr class="table-warning">

                <th colspan="3">

                    Total Obat

                </th>

                <th>

                    Rp {{ number_format($totalObat) }}

                </th>

            </tr>

            </tbody>

        </table>

    </div>

</div>
<div class="card mt-3">

    <div class="card-header">
        <strong>Total Pembayaran</strong>
    </div>

    <div class="card-body">

        <table class="table">

            <tr>
                <th>Pemeriksaan Klinis</th>
                <td class="text-end">
                    Rp {{ number_format($totalTindakan) }}
                </td>
            </tr>

            <tr>
                <th>Pemeriksaan Penunjang</th>
                <td class="text-end">
                    Rp {{ number_format($totalPenunjang) }}
                </td>
            </tr>

            <tr>
                <th>Obat-obatan</th>
                <td class="text-end">
                    Rp {{ number_format($totalObat) }}
                </td>
            </tr>

            <tr>
                <th>Ambulance</th>
                <td class="text-end">
                    Rp {{ number_format($totalAmbulance) }}
                </td>
            </tr>

            <tr class="table-success">

                <th>TOTAL</th>

                <th class="text-end">

                    Rp {{ number_format($grandTotal) }}

                </th>

            </tr>

        </table>

    </div>

</div>
<div class="col-md-6">

<label>Jenis Jaminan</label>

<select
name="jenis_jaminan"
class="form-select">

<option value="Umum">Umum</option>

<option value="BPJS">BPJS</option>

</select>

</div>
<select
id="metode"
name="metode_pembayaran"
class="form-select">

<option value="Tunai">

Tunai

</option>

<option value="QRIS">

QRIS

</option>

</select>

<div id="cashArea">

<label>

Nominal Bayar

</label>

<input
type="number"
id="bayar"
name="nominal_bayar"
class="form-control">

</div>

<div id="kembalianArea">

<label>

Kembalian

</label>

<input
type="text"
id="kembalian"
class="form-control"
readonly>

</div>



            <div class="mt-4">

                <button class="btn btn-success">

                    Simpan Pembayaran

                </button>

            </div>

        </form>

    </div>

</div>
        </div>

    </div>

</div>

<script>

const metode = document.getElementById('metode');

const bayar = document.getElementById('bayar');

const total = document.getElementById('total');

const kembali = document.getElementById('kembalian');

const cashArea = document.getElementById('cashArea');

const kembaliArea = document.getElementById('kembalianArea');

metode.addEventListener('change', function(){

    if(this.value === 'QRIS'){

        cashArea.style.display='none';

        kembaliArea.style.display='none';

        bayar.value = total.value;

    }else{

        cashArea.style.display='block';

        kembaliArea.style.display='block';

        bayar.value='';

        kembali.value='';

    }

});

bayar.addEventListener('input',function(){

    let sisa =
        parseFloat(this.value||0)
        - parseFloat(total.value||0);

    kembali.value =
        sisa > 0
        ? sisa
        : 0;

});

</script>

<div class="modal fade"
id="modalSelesai"
tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5>

Pembayaran Berhasil

</h5>

</div>

<div class="modal-body">

<i class="bi bi-check-circle-fill text-success fs-1"></i>

<p>

Pembayaran berhasil disimpan.

</p>

</div>

<div class="modal-footer">

<a
href="{{ route('pembayaran.transaksi.cetak', $kunjungan->pemeriksaan->id_pemeriksaan) }}"
target="_blank"
class="btn btn-primary"> 

Cetak Struk

</a>

<a
href="{{ route('pembayaran.selesai',$kunjungan->pemeriksaan->id_pemeriksaan) }}"
class="btn btn-success">

Selesai

</a>

</div>

</div>

</div>

</div>

</div>

</div>
@if(session('show_modal'))

<script>

new bootstrap.Modal(
document.getElementById('modalSelesai')
).show();

</script>

@endif

@endsection