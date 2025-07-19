<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tagihan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDO;

class PelangganController extends Controller
{
    // Tampilkan semua data tarif ke view
    public function index()
    {
        $data = \App\Models\Pelanggan::all(); // Ambil data dari DB
        return view('dashboard-pelanggan', compact('data')); // Kirim ke view
    }

    public function pelanggan()
    {
        $data = \App\Models\Pelanggan::all(); // Ambil data dari DB
        return view('dashboard-pelanggan', compact('data')); // Kirim ke view  
    }

    public function penggunaan()
    {
        $penggunaan = Penggunaan::with('pelanggan')->get(); // relasi eager loading
        return view('dashboard-penggunaan', compact('penggunaan'));
    }

    public function pelanggancheck(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:pelanggans',
            'password' => 'required|min:6',
            'nama_pelanggan' => 'required',
            'nomor_kwh' => 'required|unique:pelanggans',
            'alamat' => 'required',
            'id_tarif' => 'required',
        ]);

        do {
            $id = random_int(10000, 99999);
        } while (Pelanggan::where('id_pelanggan', $id)->exists());

        Pelanggan::create([
            'id_pelanggan'=> $id,
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

    public function tambahPelanggan()
    {
        return view('tambah-pelanggan');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:pelanggans',
            'password' => 'required|min:6',
            'nama_pelanggan' => 'required',
            'nomor_kwh' => 'required|unique:pelanggans',
            'alamat' => 'required',
            'id_tarif' => 'required',
        ]);

        do {
            $id = random_int(100000, 999999);
        } while (Pelanggan::where('id_pelanggan', $id)->exists());

        Pelanggan::create([
            'id_pelanggan' => $id,
            'username' => $request->username,
            'password' => Hash::make($request->password), // ← WAJIB: enkripsi
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_kwh' => $request->nomor_kwh,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
            'id_level' => 2, // atau $request->id_level
        ]);
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

    public function penggunaancheck(Request $request){
        $request->validate([
            'id_pelanggan' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_ahir' => 'required',
        ]);

        do {
            $id = random_int(1000000, 9999999);
        } while (Pelanggan::where('id_penggunaan', $id)->exists());

        // SIMPAN ke tabel tagihans
        Penggunaan::create([
            'id_penggunaan' => $id,
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $request->meter_awal,
            'meter_ahir' => $request->meter_ahir,
        ]);
    }

    public function tagihan()
    {
        $data = Tagihan::with(['penggunaan', 'pelanggan'])->get();
        $penggunaan = Penggunaan::with('pelanggan')->get();

        return view('dashboard-tagihan', compact('data', 'penggunaan'));
    }

    public function getJumlahMeter($id_pelanggan, Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        // Cari penggunaan berdasarkan id_pelanggan, bulan dan tahun
        $penggunaan = Penggunaan::where('id_pelanggan', $id_pelanggan)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        if (!$penggunaan) {
            return response()->json(['jumlah_meter' => null]);
        }

        $jumlah_meter = $penggunaan->meter_ahir - $penggunaan->meter_awal;

        return response()->json(['jumlah_meter' => $jumlah_meter]);
    }

    public function tagihancheck(Request $request)
    {
        // VALIDASI yang benar:
        $request->validate([
            'id_penggunaan' => 'required',
            'bulan' => 'required',
            'id_pelanggan' => 'required',
            'tahun' => 'required',
            'jumlah_meter' => 'required',

        ]);

        do {
            $id = random_int(1000000, 9999999);
        } while (Pelanggan::where('id_tagihan', $id)->exists());

        // SIMPAN ke tabel tagihans
        Tagihan::create([
            'id_tagihan' => $id,
            'id_penggunaan' => $request->id_penggunaan,
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_meter' => $request->jumlah_meter,
            'status' => 'Belum Bayar'
        ]);
        return redirect()->back()->with('success', 'Tagihan berhasil ditambahkan');
    }
}
