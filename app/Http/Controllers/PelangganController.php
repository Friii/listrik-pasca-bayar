<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PelangganController extends Controller
{
    // Tampilkan semua data tarif ke view
    public function index()
    {
        $data = \App\Models\Pelanggan::all(); // Ambil data dari DB
        return view('dashboard-pelanggan', compact('data')); // Kirim ke view
    }

    public function penggunaann()
    {
        $penggunaan = Penggunaan::with('pelanggan')->get(); // relasi eager loading
        return view('dashboard-penggunaan', compact('penggunaan'));
    }

    public function registercheck(Request $request)
{
    $request->validate([
        'username' => 'required|unique:pelanggans',
        'password' => 'required|min:6',
        'nama_pelanggan' => 'required',
        'nomor_kwh' => 'required|unique:pelanggans',
        'alamat' => 'required',
        'id_tarif' => 'required',
    ]);

    Pelanggan::create([
        'username' => $request->username,
        'password' => Hash::make($request->password), // ← WAJIB: enkripsi
        'nama_pelanggan' => $request->nama_pelanggan,
        'nomor_kwh' => $request->nomor_kwh,
        'alamat' => $request->alamat,
        'id_tarif' => $request->id_tarif,
        'id_level' => 2, // atau $request->id_level
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil!');
}



    // // Simpan data tarif baru
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'daya' => 'required',
    //         'tarifperkwh' => 'required|numeric'
    //     ]);

    //     Tarif::create([
    //         'daya' => $request->daya,
    //         'tarifperkwh' => $request->tarifperkwh
    //     ]);

    //     return redirect()->back()->with('success', 'Data tarif berhasil ditambahkan');
    // }
}
