<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingPelanggan()
{
    $user = Auth::user(); // login yang aktif
    $nama = $user->nama_pelanggan;

    return view('pelanggan.landing', compact('nama'));
}
}
