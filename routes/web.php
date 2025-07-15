<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;

Route::get('/login',[UserController::class, 'login'])->name('login');
Route::get('/registration-admin',[UserController::class, 'register'])->name('register.admin');
Route::post('login',[UserController::class, 'logincheck'])->name('logincheck');
Route::post('registration-admin',[UserController::class, 'registercheck'])->name('registercheck.admin');

Route::get('/registration-pelanggan', [PelangganController::class, 'register'])->name('register.pelanggan');
Route::post('/registration-pelanggan', [PelangganController::class, 'registercheck'])->name('registercheck.pelanggan');

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

// Route::get('/dashboard-tarif', [TarifController::class, 'index']);


Route::get('/landing-page', [UserController::class, 'landingPage'])->name('landingPage');


// Route::get('/dashboard-pelanggan', [PelangganController::class, 'index']);

// Route::get('/dashboard-penggunaan', [PelangganController::class, 'penggunaann']);

// Route::get('/tambah-pelanggan', function (){
//     return view('tambah-pelanggan');
// });

// Route::get('/tambah-penggunaan', function (){
//     return view('tambah-penggunaan');
// });

// Route::get('/cek-koneksi', [PelangganController::class, 'check_connection']);

