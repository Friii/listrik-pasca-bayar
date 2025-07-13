<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PelangganController;


Route::get('/', function () {
    return view('layout-dashboard');
});

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/registration-admin', function () {
    return view('registration-admin');
});

Route::get('/pelanggan', function (){
    return view('pelanggan');
});

Route::get('/dashboard', function (){
    return view('layout-dashboard');
});

Route::get('/dashboard-tarif', [TarifController::class, 'index']);


Route::get('/tambah-tarif', function (){
    return view('tambah-tarif');
});

Route::get('/dashboard-pelanggan', [PelangganController::class, 'index']);

Route::get('/dashboard-penggunaan', function (){
    return view('dashboard-penggunaan');
});

Route::get('/tambah-pelanggan', function (){
    return view('tambah-pelanggan');
});

Route::get('/tambah-penggunaan', function (){
    return view('tambah-penggunaan');
});

// Route::get('/cek-koneksi', [PelangganController::class, 'check_connection']);

