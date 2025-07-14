<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
