<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{

    public function penggunaan()
    {
        $penggunaan = Penggunaan::with('pelanggan')->get();
        $pelanggan = Pelanggan::with('pelanggan')->get(); // relasi eager loading
        return view('dashboard-penggunaan', compact('penggunaan', 'pelanggan'));
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required|numeric|min:0',
            'meter_ahir' => 'required|numeric|gt:meter_awal',
        ]);

        $penggunaan = Penggunaan::findOrFail($id);
        $penggunaan->bulan = $request->bulan;
        $penggunaan->tahun = $request->tahun;
        $penggunaan->meter_awal = $request->meter_awal;
        $penggunaan->meter_ahir = $request->meter_ahir;
        $penggunaan->save();

        return redirect()->back()->with('Berhasil', 'Penggunaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penggunaan = Penggunaan::findOrFail($id);
        $penggunaan->delete();

        return redirect()->back()->with('Berhasil', 'Penggunaan berhasil dihapus');
    }
}
