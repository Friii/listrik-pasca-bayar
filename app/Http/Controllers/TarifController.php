<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;
use Illuminate\Support\Facades\DB;
use Exception;


class TarifController extends Controller
{
    public function check_connection()
    {
        try {
            DB::connection()->getPdo();
            $dbName = DB::connection()->getDatabaseName();
            return "✅ Terhubung ke database: <strong>$dbName</strong>";
        } catch (Exception $e) {
            return "❌ Tidak dapat terhubung ke database.<br>Pesan error: " . $e->getMessage();
        }
    }

    // Tampilkan semua data tarif ke view
    public function index()
    {
        $data = \App\Models\Tarif::all(); // Ambil data dari DB
        return view('dashboard-tarif', compact('data')); // Kirim ke view
    }

    // Simpan data tarif baru
    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required',
            'tarifperkwh' => 'required|numeric'
        ]);

        Tarif::create([
            'daya' => $request->daya,
            'tarifperkwh' => $request->tarifperkwh
        ]);

        return redirect()->back()->with('success', 'Data tarif berhasil ditambahkan');
    }
}
