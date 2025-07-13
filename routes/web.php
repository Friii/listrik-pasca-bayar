<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard-tarif', function (){
    return view('dashboard-tarif');
});

Route::get('/dashboard-pelanggan', function (){
    return view('dashboard-pelanggan');
});

Route::get('/dashboard-penggunaan', function (){
    return view('dashboard-penggunaan');
});
