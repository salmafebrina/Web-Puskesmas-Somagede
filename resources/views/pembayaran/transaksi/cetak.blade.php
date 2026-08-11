<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Struk Pembayaran</title>

<style>

body{

    font-family: monospace;

    width:300px;

    margin:auto;

    font-size:13px;

}

.center{

    text-align:center;

}

table{

    width:100%;

}

hr{

    border-top:1px dashed black;

}

</style>

</head>

<body>

<div class="center">

<b>PUSKESMAS SOMAGEDE</b><br>

Jl. Raya Somagede<br>

Kabupaten Banyumas

</div>

<hr>

No Transaksi :
{{ $transaksi->no_transaksi }}

<br>

Tanggal :

{{ $transaksi->tanggal_pembayaran }}

<hr>

Nama :

{{ $transaksi->kunjungan->pasien->nama_pasien }}

<br>

No RM :

{{ $transaksi->kunjungan->pasien->id_rekam_medis ?? '-' }}

<br>

Pembiayaan :

{{ $transaksi->kunjungan->jenis_pembiayaan }}

<hr>

<b>PEMERIKSAAN KLINIS</b>

<table>

@foreach($detailTindakan as $item)

<tr>

<td>

{{ $item['nama'] }}

</td>

<td align="right">

{{ number_format($item['tarif']) }}

</td>

</tr>

@endforeach

</table>

<hr>

<b>PEMERIKSAAN PENUNJANG</b>

<table>

@foreach($detailPenunjang as $item)

<tr>

<td>

{{ $item['nama'] }}

</td>

<td align="right">

{{ number_format($item['tarif']) }}

</td>

</tr>

@endforeach

</table>

<hr>

<b>OBAT</b>

<table>

@foreach($detailObat as $item)

<tr>

<td>

{{ $item['nama'] }}

x{{ $item['jumlah'] }}

</td>

<td align="right">

{{ number_format($item['subtotal']) }}

</td>

</tr>

@endforeach

</table>

<hr>

<table>

<tr>

<td>

TOTAL

</td>

<td align="right">

Rp {{ number_format($grandTotal) }}

</td>

</tr>

<tr>

<td>

Bayar

</td>

<td align="right">

Rp {{ number_format($transaksi->nominal_bayar) }}

</td>

</tr>

<tr>

<td>

Kembali

</td>

<td align="right">

Rp {{ number_format($transaksi->kembalian) }}

</td>

</tr>

</table>

<hr>

<div class="center">

Terima Kasih

<br>

Semoga Lekas Sembuh

</div>

<script>

window.print();

</script>

</body>

</html>