<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
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
        $data = \App\Models\Pelanggan::with('tarif')->get(); // Ambil data dari DB
        return view('dashboard-pelanggan', compact('data')); // Kirim ke view
    }

    public function penggunaan()
    {
        $penggunaan = Penggunaan::with('pelanggan')->get();
        $pelanggan = Pelanggan::with('pelanggan')->get(); // relasi eager loading
        return view('dashboard-penggunaan', compact('penggunaan', 'pelanggan'));
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
        } while (Penggunaan::where('id_pelanggan', $id)->exists());

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
            'id_level' => 2,
        ]);
    }


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

    public function penggunaancheck(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_ahir' => 'required',
        ]);

        do {
            $id = random_int(5000000, 6000000);
        } while (Penggunaan::where('id_penggunaan', $id)->exists());

        Penggunaan::create([
            'id_penggunaan' => $id,
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $request->meter_awal,
            'meter_ahir' => $request->meter_ahir,
        ]);

        return redirect()->back()->with('Berhasil');
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

        $request->validate([
            'id_penggunaan' => 'required',
            'bulan' => 'required',
            'id_pelanggan' => 'required',
            'tahun' => 'required',
            'jumlah_meter' => 'required',

        ]);

        do {
            $id = random_int(1000000, 9999999);
        } while (Tagihan::where('id_tagihan', $id)->exists());

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


    public function pembayaran()
    {
        $data = Pembayaran::with(['tagihan.penggunaan', 'pelanggan.tarif'])->get();
        $pelanggan = Pelanggan::with('tarif')->get(); // Jika mau dipakai di select form
        $tagihan = Tagihan::with('penggunaan')->get(); // Jika mau ditampilkan nama bulan/tahun

        // dd($request->all());
        return view('dashboard-pembayaran', compact('data', 'pelanggan', 'tagihan'));
    }

    public function pembayarancheck(Request $request)
    {
        $request->validate([
            'id_tagihan' => 'required|exists:tagihans,id_tagihan',
            'id_user' => 'required|exists:user,id_user',
            'tanggal_pembayaran' => 'required|date',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil data tagihan dan relasi penggunaan
        $tagihan = Tagihan::with('penggunaan')->findOrFail($request->id_tagihan);

        // Ambil id_pelanggan dari relasi penggunaan
        $id_pelanggan = $tagihan->penggunaan->id_pelanggan;

        // Ambil data pelanggan beserta tarifnya
        $pelanggan = Pelanggan::with('tarif')->findOrFail($id_pelanggan);

        // Hitung total bayar
        $jumlah_meter = $tagihan->jumlah_meter;
        $tarif_perkwh = $pelanggan->tarif->tarifperkwh;
        $biaya_admin = 2500;
        $total_bayar = ($jumlah_meter * $tarif_perkwh) + $biaya_admin;

        // Upload bukti pembayaran ke storage/app/public/bukti_pembayaran
        $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');

        // Generate ID pembayaran unik
        do {
            $id = random_int(8000000, 9999999);
        } while (Pembayaran::where('id_pembayaran', $id)->exists());

        // Simpan data ke database
        Pembayaran::create([
            'id_pembayaran' => $id,
            'id_pelanggan' => $id_pelanggan,
            'id_tagihan' => $request->id_tagihan,
            'id_user' => $request->id_user,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $total_bayar,
            'bukti' => $buktiPath,
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil ditambahkan');
    }


    // app/Http/Controllers/PelangganController.php

    // ... (method Anda yang lain)

    public function getTotalBayar($id_tagihan)
    {
        $tagihan = Tagihan::with('penggunaan', 'pelanggan.tarif')->find($id_tagihan);

        if (!$tagihan) {
            return response()->json(['error' => 'Tagihan tidak ditemukan'], 404);
        }

        $jumlah_meter = $tagihan->jumlah_meter;
        $tarif_per_kwh = $tagihan->pelanggan->tarif->tarifperkwh ?? 0;

        $total = $jumlah_meter * $tarif_per_kwh;

        return response()->json(['total_bayar' => $total]);
    }
}
