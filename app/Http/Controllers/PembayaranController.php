<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
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

        $tagihan = Tagihan::find($request->id_tagihan);
        if ($tagihan) {
            $tagihan->status = 'Berhasil Dibayar';
            $tagihan->save();
        }

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pembayaran' => 'required|date',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        // Update bukti jika ada file baru
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
            $pembayaran->bukti = $buktiPath;
        }

        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->save();

        return redirect()->back()->with('success', 'Data pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus');
    }

    public function show($id)
    {
        $tagihan = Tagihan::with('pelanggan')->findOrFail($id);
        return view('bayar', compact('tagihan'));
    }

    public function prosesBayar(Request $request)
    {   
        $tagihan = Tagihan::with('penggunaan')->findOrFail($request->id_tagihan);
        $biaya_admin = 2500;
        // Simpan file bukti
        $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        do {
            $id = random_int(8000000, 9999999);
        } while (Pembayaran::where('id_pembayaran', $id)->exists());

        // Simpan ke tabel pembayaran (atau update tagihan)
        Pembayaran::create([
            'id_pembayaran' => $id,
            'id_tagihan' => $request->id_tagihan,
            'id_pelanggan' => $request->id_pelanggan,
            'id_user' => 15828,
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $request->total_bayar,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'bukti' => $buktiPath,
            'status' => 'Menunggu Konfirmasi',
        ]);

        $tagihan = Tagihan::find($request->id_tagihan);
        if ($tagihan) {
            $tagihan->status = 'Berhasil Dibayar';
            $tagihan->save();
        }

        return redirect()->route('kelolaLandingPage')->with('success', 'Pembayaran berhasil dikirim, menunggu konfirmasi.');
    }
}
