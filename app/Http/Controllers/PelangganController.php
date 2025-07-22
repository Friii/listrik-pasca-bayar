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
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function pelanggan()
    {
        $data = \App\Models\Pelanggan::with('tarif')->get(); // Ambil data dari DB
        return view('dashboard-pelanggan', compact('data')); // Kirim ke view
    }

    public function loginPelanggan()
    {
        return view('login-pelanggan');
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
            'username' => 'required|unique:pelanggans',
            'password' => 'required|min:6',
            'nama_pelanggan' => 'required',
            'nomor_kwh' => 'required|unique:pelanggans',
            'alamat' => 'required',
            'id_tarif' => 'required',
        ]);

        do {
            $id = random_int(100000, 999999);
        } while (\App\Models\Pelanggan::where('id_pelanggan', $id)->exists());

        \App\Models\Pelanggan::create([
            'id_pelanggan' => $id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_kwh' => $request->nomor_kwh,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
            'id_level' => 2,
        ]);

        return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan');
    }
    public function edit($id)
    {
        $pelanggan = \App\Models\Pelanggan::findOrFail($id);
        return view('edit-pelanggan', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarifs,id_tarif',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ]);

        return redirect()->route('tambah.pelanggan')->with('success', 'Pelanggan berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->back()->with('success', 'Data pelanggan berhasil dihapus.');
    }

    public function index(Request $request)
    {
        // Memulai query ke model Pelanggan dengan eager loading relasi 'tarif'
        $query = Pelanggan::with('tarif');

        // Mengecek apakah ada input 'search' dari form
        if ($request->has('search') && $request->search != '') {
            // Jika ada, tambahkan kondisi WHERE LIKE untuk mencari nama pelanggan
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%');
        }

        // Ambil data hasil query
        $data = $query->paginate(10); // Menggunakan paginate untuk data yang banyak lebih baik

        // Kirim data ke view
        return view('dashboard-pelanggan', compact('data'));
    }

    public function landing()
    {
        // Ambil id pelanggan dari session
        $id = session('pelanggan_id');

        // Ambil data pelanggan dari database
        $pelanggan = \App\Models\Pelanggan::find($id);

        // Kirim ke view
        return view('landing-page', compact('pelanggan'));
    }


    public function landingcheck(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]); // hasil true / false

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->id_level == 2) {
                return redirect()->route('kelolaLandingPage');
            }
        }

        $pelanggan = \App\Models\Pelanggan::where('username', $credentials['username'])->first();
        if ($pelanggan && Hash::check($credentials['password'], $pelanggan->password)) {
            // Login manual pelanggan
            session(['pelanggan_id' => $pelanggan->id_pelanggan]);
            return redirect()->route('kelolaLandingPage');
        }

        return back()->withErrors(['loginPelanggan' => 'Username atau password salah']);
    }

    public function kelolaLandingPage(Request $request)
{
    // Ambil pelanggan dari session, bukan dari Auth
    $pelangganLogin = Pelanggan::find(session('pelanggan_id'));

    if (!$pelangganLogin) {
        return redirect()->route('loginPelanggan')->with('error', 'Data pelanggan tidak ditemukan.');
    }

    if ($request->isMethod('post')) {
        $request->validate(['id_tagihan' => 'required']);

        $tagihan = Tagihan::with('penggunaan.pelanggan.tarif')
            ->where('id_tagihan', $request->id_tagihan)
            ->first();

        if (!$tagihan) {
            return back()->withErrors(['id_tagihan' => 'Tagihan tidak ditemukan.']);
        }

        if ($tagihan->penggunaan->pelanggan->id_pelanggan != $pelangganLogin->id_pelanggan) {
            return back()->withErrors(['id_tagihan' => 'Anda tidak memiliki akses ke tagihan ini.']);
        }

        return view('landing-page', [
            'pelanggan' => $pelangganLogin,
            'tagihan' => $tagihan
        ]);
    }

    return view('landing-page', ['pelanggan' => $pelangganLogin]);
}

}
