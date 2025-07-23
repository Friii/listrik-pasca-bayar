<?php

use App\Http\Controllers\LandingController;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Penggunaan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenggunaanController;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/registration-admin', [UserController::class, 'register'])->name('register.admin');
Route::post('login', [UserController::class, 'logincheck'])->name('logincheck');
Route::post('registration-admin', [UserController::class, 'registercheck'])->name('registercheck.admin');

Route::get('/registration-pelanggan', [PelangganController::class, 'pelanggan'])->name('register.pelanggan');
Route::post('/registration-pelanggan', [PelangganController::class, 'pelanggancheck'])->name('registercheck.pelanggan');

Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/delete/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');


Route::get('/dashboard-tarif', [TarifController::class, 'index'])->name('tarif.pelanggan');
Route::post('/dashboard-tarif', [TarifController::class, 'store'])->name('tarifcheck.pelanggan');
Route::put('/tarif/update/{id}', [TarifController::class, 'update'])->name('tarif.update');
Route::delete('/tarif/{id}', [TarifController::class, 'destroy'])->name('tarif.destroy');

Route::get('/dashboard-penggunaan', [PenggunaanController::class, 'penggunaan'])->name('penggunaan.pelanggan');
Route::post('/dashboard-penggunaan', [PenggunaanController::class, 'penggunaancheck'])->name('penggunaancheck.pelanggan');
Route::post('/penggunaan/update/{id}', [PenggunaanController::class, 'update'])->name('penggunaan.update');
Route::delete('/penggunaan/delete/{id}', [PenggunaanController::class, 'destroy'])->name('penggunaan.destroy');


Route::get('/dashboard-tagihan', [TagihanController::class, 'tagihan'])->name('tagihan.pelanggan');
Route::post('/dashboard-tagihan', [TagihanController::class, 'tagihancheck'])->name('tagihancheck.pelanggan');
Route::post('/tagihan/update/{id}', [TagihanController::class, 'update'])->name('tagihan.update');
Route::delete('/tagihan/delete/{id}', [TagihanController::class, 'destroy'])->name('tagihan.destroy');

Route::get('/dashboard-pembayaran', [PembayaranController::class, 'pembayaran'])->name('pembayaran.pelanggan');
Route::post('/dashboard-pembayaran', [PembayaranController::class, 'pembayarancheck'])->name('pembayarancheck.pelanggan');
Route::post('/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayaran/delete/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
Route::get('/api/jumlah-meter/{id_pelanggan}', [TagihanController::class, 'getJumlahMeter']);

Route::get('/get-total-bayar/{id_tagihan}', [PembayaranController::class, 'getTotalBayar']);




// Biasanya sudah otomatis ada, tapi pastikan:
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



Route::middleware(['auth', 'ceklevel:1'])->group(function () {
    Route::get('/layout-dashboard', [UserController::class, 'dashboardAdmin'])->name('dashboardAdmin');
});

Route::middleware(['auth', 'ceklevel:2'])->group(function () {
    Route::get('/wattly', [LandingController::class, 'landingPelanggan'])->name('pelanggan.landing');
});

Route::get('/dashboard', [UserController::class, 'goDashboard'])->name('dashboard');

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/wattly', [LandingController::class, 'data'])->name('data.pelanggan');

Route::get('/kwitansi', function () {
    return view('kwitansi');
});

Route::get('/bayar/{id}', [PembayaranController::class, 'show'])->name('bayar.show');

Route::post('/bayar/{id}', [PembayaranController::class, 'prosesBayar'])->name('bayar');

// Route::get('/dashboard', function (){
//     return view('layout-dashboard');
// });



Route::get('/landing-page', [UserController::class, 'landingPage'])->name('landingPage');


Route::get('/dashboard-pelanggan', [PelangganController::class, 'pelanggan'])->name('tambah.pelanggan');
Route::post('dashboard-pelanggan', [PelangganController::class, 'pelanggancheck'])->name('pelanggancheck.admin');


// Route::get('/tambah-pelanggan', function (){
//     return view('tambah-pelanggan');
// });

// Route::get('/tambah-penggunaan', function (){
//     return view('tambah-penggunaan');
// });

// Route::get('/cek-koneksi', [PelangganController::class, 'check_connection']);


Route::get('/login-selection', function () {
    return view('pilihan-login');
})->name('login.selection');

// Form login masing-masing
Route::get('/login', [UserController::class, 'login'])->name('login'); // admin

// // halaman form login pelanggan
// Route::get('/login-pelanggan', [PelangganController::class, 'loginPelanggan'])->name('login.pelanggan');

// proses login pelanggan
Route::post('/login/pelanggan', [PelangganController::class, 'landingcheck'])->name('landingcheck');

// halaman setelah login pelanggan
Route::match(['get', 'post'], '/wattly', [PelangganController::class, 'kelolaLandingPage'])->name('kelolaLandingPage');

Route::get('/login-pelanggan', [PelangganController::class, 'loginPelanggan'])->name('loginPelanggan');