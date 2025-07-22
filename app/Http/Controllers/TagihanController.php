<?php

namespace App\Http\Controllers;


use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TagihanController extends Controller
{
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
        ]);

        // Generate ID unik
        do {
            $id = random_int(1000000, 9999999);
        } while (Tagihan::where('id_tagihan', $id)->exists());

        // Ambil data penggunaan
        $penggunaan = Penggunaan::findOrFail($request->id_penggunaan);

        // Hitung jumlah meter
        $jumlah_meter = $penggunaan->meter_ahir - $penggunaan->meter_awal;

        // Ambil tarif dari pelanggan
        $pelanggan = Pelanggan::with('tarif')->findOrFail($request->id_pelanggan);
        $tarifPerKwh = $pelanggan->tarif->tarifperkwh ?? 0;

        // Hitung total bayar
        $biayaAdmin = 2500;
        $totalBayar = ($jumlah_meter * $tarifPerKwh) + $biayaAdmin;

        Log::info('Hitung Total Bayar', [
            'meter_awal' => $penggunaan->meter_awal,
            'meter_ahir' => $penggunaan->meter_ahir,
            'jumlah_meter' => $jumlah_meter,
            'tarif_per_kwh' => $tarifPerKwh,
            'biaya_admin' => $biayaAdmin,
            'total_bayar' => $totalBayar
        ]);
        // Simpan ke database
        Tagihan::create([
            'id_tagihan' => $id,
            'id_penggunaan' => $request->id_penggunaan,
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_meter' => $jumlah_meter,
            'status' => 'Belum Bayar',
            'total_bayar' => $totalBayar
        ]);

        return redirect()->back()->with('success', 'Tagihan berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah_meter' => 'required|numeric',
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->bulan = $request->bulan;
        $tagihan->tahun = $request->tahun;
        $tagihan->jumlah_meter = $request->jumlah_meter;
        $tagihan->save();

        return redirect()->back()->with('success', 'Tagihan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()->back()->with('success', 'Tagihan berhasil dihapus');
    }
}
