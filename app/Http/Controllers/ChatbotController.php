<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;


class ChatbotController extends Controller
{
    /**
     * Menampilkan halaman chatbot.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Middleware 'auth:pelanggan' yang ada di routes/web.php sudah memastikan
        // bahwa hanya pelanggan yang sudah login yang bisa mengakses ini.
        //
        // Auth::user() akan secara otomatis mengambil SATU data Pelanggan yang sedang login.
        // Ini mengembalikan sebuah objek Model, BUKAN koleksi.
        $pelanggan = Auth::user();

        // Tidak perlu lagi melakukan pengecekan if (!$pelanggan),
        // karena middleware sudah menjalankan tugasnya.

        // Kirim satu objek pelanggan ke view.
        return view('chatbot', compact('pelanggan'));
    }
}
