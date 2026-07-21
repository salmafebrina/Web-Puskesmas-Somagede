<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PemeriksaanAwalController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ObatMasukController;
use App\Http\Controllers\FarmasiController;

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/pendaftaran', [PendaftaranController::class, 'index']);

Route::get('/pemeriksaan', function () {
    return view('pemeriksaan.dashboard');
});

Route::get('/pembayaran', [PembayaranController::class, 'index']);

Route::get('/obat', function () {
    return view('obat');
});

/*
|--------------------------------------------------------------------------
| Master Data
|--------------------------------------------------------------------------
*/

Route::resource('pasien', PasienController::class);

Route::resource('obat', ObatController::class);


/*
|--------------------------------------------------------------------------
| Antrian
|--------------------------------------------------------------------------
*/

Route::resource('antrian', AntrianController::class);
Route::get(
    '/cek-pasien/{nik}',
    [AntrianController::class, 'cekPasien']
)->name('cek.pasien');

Route::get('/cari-pasien', [AntrianController::class, 'cariPasien']);

/*
|--------------------------------------------------------------------------
| Daftar Kunjungan
|--------------------------------------------------------------------------
*/

Route::get(
    '/daftar',
    [PendaftaranController::class, 'daftar']
)->name('pendaftaran.daftar.index');

/*
|--------------------------------------------------------------------------
| Kunjungan
|--------------------------------------------------------------------------
*/

Route::get(
    '/kunjungan/create/{id}',
    [KunjunganController::class, 'create']
)->name('kunjungan.create');

Route::post(
    '/kunjungan/store',
    [KunjunganController::class, 'store']
)->name('kunjungan.store');

/*
|--------------------------------------------------------------------------
| Riwayat Pendaftaran
|--------------------------------------------------------------------------
*/

Route::get(
    '/riwayat-pendaftaran',
    [PendaftaranController::class,'riwayat']
)->name('pendaftaran.riwayat.index');

Route::get(
    '/riwayat-pendaftaran/{id}',
    [PendaftaranController::class,'show']
)->name('pendaftaran.riwayat.show');

Route::get(
    '/riwayat-pendaftaran/{id}/edit',
    [PendaftaranController::class,'edit']
)->name('pendaftaran.riwayat.edit');

Route::put(
    '/riwayat-pendaftaran/{id}',
    [PendaftaranController::class,'update']
)->name('pendaftaran.riwayat.update');

/*
|--------------------------------------------------------------------------
| Pemeriksaan Awal
|--------------------------------------------------------------------------
*/

Route::get(
    '/pemeriksaan_awal',
    [PemeriksaanAwalController::class, 'index']
)->name('pemeriksaan.awal.index');

Route::get(
    '/pemeriksaan/awal/{namaPoli}',
    [PemeriksaanAwalController::class, 'poli']
)->name('pemeriksaan.awal.poli');

Route::get(
    '/pemeriksaan_awal/{id}',
    [PemeriksaanAwalController::class, 'create']
)->name('pemeriksaan.awal.create');

Route::post(
    '/pemeriksaan_awal',
    [PemeriksaanAwalController::class, 'store']
)->name('pemeriksaan.awal.store');

/*
|--------------------------------------------------------------------------
| Pemeriksaan Poli
|--------------------------------------------------------------------------
*/

Route::get(
    '/pemeriksaan_poli',
    [PoliController::class, 'index']
)->name('pemeriksaan.poli.index');

Route::get(
    '/pemeriksaan_poli/{id}',
    [PoliController::class, 'create']
)->name('pemeriksaan.poli.create');

Route::post(
    '/pemeriksaan_poli',
    [PoliController::class, 'store']
)->name('pemeriksaan.poli.store');

/*
|--------------------------------------------------------------------------
| Riwayat Pemeriksaan
|--------------------------------------------------------------------------
*/

Route::get(
    '/riwayat-pemeriksaan',
    [PoliController::class, 'index']
)->name('pemeriksaan.riwayat.index');


/*
|--------------------------------------------------------------------------
| Pembayaran
|----------------------------------------------------------------------------
*/
Route::resource('pembayaran/tarif', TarifController::class);

Route::get(
    '/pembayaran/transaksi',
    [TarifController::class, 'index']
)->name('pembayaran.transaksi.index');

Route::get(
    '/pembayaran/transaksi/{id}',
    [TarifController::class, 'create']
)->name('pembayaran.transaksi.create');

Route::post(
    '/pembayaran/transaksi',
    [TarifController::class, 'store']
)->name('pembayaran.transaksi.store');

/*
|--------------------------------------------------------------------------
| Pembayaran Tarif
|----------------------------------------------------------------------------*/

Route::get(
    '/pembayaran/tarif',
    [TarifController::class, 'index']
)->name('pembayaran.tarif.index');

Route::get(
    '/pembayaran/tarif/{id}',
    [TarifController::class, 'create']
)->name('pembayaran.tarif.create');

Route::post(
    '/pembayaran/tarif',
    [TarifController::class, 'store']
)->name('pembayaran.tarif.store');

/*
|--------------------------------------------------------------------------
| Riwayat Pembayaran
|----------------------------------------------------------------------------*/ 

Route::get(
    '/pembayaran/riwayat',
    [PembayaranController::class, 'index']
)->name('pembayaran.riwayat.index');

Route::get(
    '/pembayaran/riwayat/{id}',
    [PembayaranController::class, 'create']
)->name('pembayaran.riwayat.create');

Route::post(
    '/pembayaran/riwayat',
    [PembayaranController::class, 'store']
)->name('pembayaran.riwayat.store');


/*
|--------------------------------------------------------------------------
| Obat Masuk
|--------------------------------------------------------------------------
*/  
Route::resource('obat-masuk', ObatMasukController::class);


/*
|--------------------------------------------------------------------------
| Farmasi
|--------------------------------------------------------------------------
*/

Route::get('/farmasi', [FarmasiController::class, 'farmasi'])
    ->name('farmasi');

Route::get('/farmasi/Antrian-Resep', [FarmasiController::class, 'penyerahan'])
    ->name('farmasi.ObatKeluar.index');

Route::get('/farmasi/Antrian-Resep/{id}', [FarmasiController::class, 'create'])
    ->name('farmasi.ObatKeluar.create');

Route::post('/farmasi/Antrian-Resep', [FarmasiController::class, 'store'])
    ->name('farmasi.ObatKeluar.store');

Route::get('/farmasi/Riwayat-Penyerahan', [FarmasiController::class, 'riwayat'])
    ->name('farmasi.riwayat.index');


/*
|--------------------------------------------------------------------------
| Testing
|--------------------------------------------------------------------------
*/

Route::get('/tes', function () {
    return 'TES BERHASIL';
});
