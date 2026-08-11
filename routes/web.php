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
use App\Http\Controllers\Icd10Controller;
use App\Http\Controllers\RujukanController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\RiwayatPemeriksaanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ObatMasukController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\AdminController;


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

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Manajemen User
    Route::get('/user',                [AdminController::class, 'userIndex'])  ->name('user.index');
    Route::get('/user/create',         [AdminController::class, 'userCreate']) ->name('user.create');
    Route::post('/user',               [AdminController::class, 'userStore'])  ->name('user.store');
    Route::get('/user/{id}/edit',      [AdminController::class, 'userEdit'])   ->name('user.edit');
    Route::put('/user/{id}',           [AdminController::class, 'userUpdate']) ->name('user.update');
    Route::delete('/user/{id}',        [AdminController::class, 'userDestroy'])->name('user.destroy');
    Route::post('/user/{id}/toggle',   [AdminController::class, 'userToggle']) ->name('user.toggle');

    // Data Pasien
    Route::get('/pasien',              [AdminController::class, 'pasienIndex'])  ->name('pasien.index');
    Route::get('/pasien/{id}',         [AdminController::class, 'pasienShow'])   ->name('pasien.show');
    Route::get('/pasien/{id}/edit',    [AdminController::class, 'pasienEdit'])   ->name('pasien.edit');
    Route::put('/pasien/{id}',         [AdminController::class, 'pasienUpdate']) ->name('pasien.update');
    Route::delete('/pasien/{id}',      [AdminController::class, 'pasienDestroy'])->name('pasien.destroy');

    // Data Obat
    Route::get('/obat',                [AdminController::class, 'obatIndex'])  ->name('obat.index');
    Route::get('/obat/create',         [AdminController::class, 'obatCreate']) ->name('obat.create');
    Route::post('/obat',               [AdminController::class, 'obatStore'])  ->name('obat.store');
    Route::get('/obat/{id}/edit',      [AdminController::class, 'obatEdit'])   ->name('obat.edit');
    Route::put('/obat/{id}',           [AdminController::class, 'obatUpdate']) ->name('obat.update');
    Route::delete('/obat/{id}',        [AdminController::class, 'obatDestroy'])->name('obat.destroy');

    // Data Tarif
    Route::get('/tarif',               [AdminController::class, 'tarifIndex'])  ->name('tarif.index');
    Route::get('/tarif/create',        [AdminController::class, 'tarifCreate']) ->name('tarif.create');
    Route::post('/tarif',              [AdminController::class, 'tarifStore'])  ->name('tarif.store');
    Route::get('/tarif/{id}/edit',     [AdminController::class, 'tarifEdit'])   ->name('tarif.edit');
    Route::put('/tarif/{id}',          [AdminController::class, 'tarifUpdate']) ->name('tarif.update');
    Route::delete('/tarif/{id}',       [AdminController::class, 'tarifDestroy'])->name('tarif.destroy');

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

Route::prefix('pemeriksaan_poli')->name('pemeriksaan.poli.')->group(function () {

    Route::get('/', [PoliController::class, 'index'])
        ->name('index');

    Route::get('/{id}', [PoliController::class, 'create'])
        ->name('create');

    Route::post('/store', [PoliController::class, 'store'])
        ->name('store');

});

/*|search for diagnosis|*/
Route::get(
    '/icd10/search',
    [Icd10Controller::class,'search']
);

Route::get(
    '/icd10/search',
    [Icd10Controller::class, 'search']
)->name('icd10.search');

/*
|--resep--|*/
Route::get(
    '/resep/{id}',
    [ResepController::class, 'show']
)->name('resep.show');

// Laboratorium
    Route::prefix('laboratorium')
    ->name('laboratorium.')
    ->group(function () {

        Route::get('/', [LaboratoriumController::class,'index'])
            ->name('index');

        Route::get('/{id}', [LaboratoriumController::class,'show'])
            ->name('show');

        Route::put('/{id}', [LaboratoriumController::class,'update'])
            ->name('update');

});

// Rujukan
Route::prefix('rujukan')
    ->name('rujukan.')
    ->group(function () {

        Route::get('/', [RujukanController::class,'index'])
            ->name('index');

        Route::get('/{id}', [RujukanController::class,'show'])
            ->name('show');

});
/*
|--------------------------------------------------------------------------
| Riwayat Pemeriksaan
|--------------------------------------------------------------------------
*/

Route::get(
    '/riwayat-pemeriksaan',
    [RiwayatPemeriksaanController::class, 'index']
)->name('pemeriksaan.riwayat.index');

Route::prefix('pemeriksaan')->name('pemeriksaan.')->group(function () {
    Route::get(
        '/riwayat/{id}',
        [RiwayatPemeriksaanController::class, 'show']
    )->name('riwayat.show');

});


/*
|--------------------------------------------------------------------------
| Pembayaran
|----------------------------------------------------------------------------
*/
Route::prefix('pembayaran')->name('pembayaran.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Pembayaran
    |--------------------------------------------------------------------------
    */
    Route::get('/', [PembayaranController::class, 'dashboard'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Transaksi Pembayaran
    |--------------------------------------------------------------------------
    */
    Route::get('/transaksi', [PembayaranController::class, 'index'])
        ->name('index');

    Route::get('/transaksi/{id}', [PembayaranController::class, 'show'])
        ->name('show');

    Route::post('/transaksi/{id}', [PembayaranController::class, 'store'])
        ->name('store');

    /*
    |--------------------------------------------------------------------------
    | Riwayat Pembayaran
    |--------------------------------------------------------------------------
    */
    Route::get('/riwayat', [PembayaranController::class, 'riwayat'])
        ->name('riwayat.index');

    Route::get('/riwayat/{id}', [PembayaranController::class, 'showRiwayat'])
        ->name('riwayat.show');

    Route::get('/{id}/selesai',[ PembayaranController::class,'selesai'])
        ->name('selesai'); 
    /*
    |--------------------------------------------------------------------------
    | Cetak Bukti Pembayaran
    |--------------------------------------------------------------------------
    */
    Route::get('/{id}/cetak',[ PembayaranController::class,'cetak'])
        ->name('transaksi.cetak');
    });
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

    Route::get(
'/farmasi/Riwayat-Penyerahan/{id}',
[FarmasiController::class,'showRiwayat']
)->name('farmasi.riwayat.show');

    Route::post(
    '/farmasi/obat-keluar',
    [FarmasiController::class,'store']
    )->name('farmasi.store');

/*
|--------------------------------------------------------------------------
| Testing
|--------------------------------------------------------------------------
*/

Route::get('/tes', function () {
    return 'TES BERHASIL';
});
