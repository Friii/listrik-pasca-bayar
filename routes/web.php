<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;

Route::get('/login',[UserController::class, 'login'])->name('login');
Route::get('/registration-admin',[UserController::class, 'register'])->name('register.admin');
Route::post('login',[UserController::class, 'logincheck'])->name('logincheck');
Route::post('registration-admin',[UserController::class, 'registercheck'])->name('registercheck.admin');

Route::get('/registration-pelanggan', [PelangganController::class, 'pelanggan'])->name('register.pelanggan');
Route::post('/registration-pelanggan', [PelangganController::class, 'pelanggancheck'])->name('registercheck.pelanggan');

Route::get('/dashboard-tarif', [TarifController::class, 'index'])->name('tarif.pelanggan');
Route::post('/dashboard-tarif', [TarifController::class, 'store'])->name('tarifcheck.pelanggan');

Route::get('/dashboard-penggunaan', [PelangganController::class, 'penggunaan'])->name('penggunaan.pelanggan');
Route::post('/dashboard-penggunaan', [PelangganController::class, 'penggunaancheck'])->name('penggunaancheck.pelanggan');

Route::get('/dashboard-tagihan', [PelangganController::class, 'tagihan'])->name('tagihan.pelanggan');
Route::post('/dashboard-tagihan', [PelangganController::class, 'tagihancheck'])->name('tagihancheck.pelanggan');
Route::get('/dashboard-pembayaran', [PelangganController::class, 'pembayaran'])->name('pembayaran.pelanggan');
Route::post('/dashboard-pembayaran', [PelangganController::class,'pembayarancheck'])->name('pembayarancheck.pelanggan');
Route::get('/api/jumlah-meter/{id_pelanggan}', [PelangganController::class, 'getJumlahMeter']);

Route::get('/get-total-bayar/{id_tagihan}', [PelangganController::class, 'getTotalBayar']);




Route::middleware(['auth', 'ceklevel:1'])->group(function () {
    Route::get('/layout-dashboard', [UserController::class, 'dashboardAdmin'])->name('dashboardAdmin');
});

Route::middleware(['auth', 'ceklevel:2'])->group(function () {
    Route::get('/dashboard-pelanggan', [UserController::class, 'dashboardPelanggan'])->name('dashboardPelanggan');
});

Route::get('/dashboard',[UserController::class, 'goDashboard'])->name('dashboard');

Route::get('/pelanggan', function (){
    return view('pelanggan');
});
Route::get('/registration', function (){
    return view('registration');
});

// Route::get('/dashboard', function (){
//     return view('layout-dashboard');
// });



Route::get('/landing-page', [UserController::class, 'landingPage'])->name('landingPage');


Route::get('/dashboard-pelanggan', [PelangganController::class, 'index'])->name('tambah.pelanggan');
Route::post('dashboard-pelanggan',[PelangganController::class, 'pelanggancheck'])->name('pelanggancheck.admin');


// Route::get('/tambah-pelanggan', function (){
//     return view('tambah-pelanggan');
// });

// Route::get('/tambah-penggunaan', function (){
//     return view('tambah-penggunaan');
// });

// Route::get('/cek-koneksi', [PelangganController::class, 'check_connection']);

