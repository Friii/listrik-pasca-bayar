<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('welcome');
    }

    public function loginpelanggan()
    {
        return view('pelanggan');
    }

    public function register()
    {
        return view('registration-admin');
    }

    public function dashboardAdmin()
    {
        $totalUser = User::count();
        $totalPelanggan = Pelanggan::count();
        $totalPembayaran = Pembayaran::count();
        $totalTagihan = Tagihan::count();
        return view('layout-dashboard', ['totalUser' => $totalUser, 'totalPelanggan' => $totalPelanggan, 'totalPembayaran' =>$totalPembayaran, 'totalTagihan' =>$totalTagihan]);
    }

    public function landingPage()
    {
        return view('tambah-tarif');
    }

    public function registercheck(Request $request)
    {
        $validation = $request->validate([
            'username'   => 'required|unique:user',
            'password'   => 'required',
            'nama_admin' => 'required'
        ]);
        do {
            $id = random_int(10000, 99999);
        } while (User::where('id_user', $id)->exists());

        $user = User::create([
            'id_user'    => $id,
            'username'   => $validation['username'],
            'password'   => bcrypt($validation['password']),
            'nama_admin' => $validation['nama_admin'],
            'id_level'   => 1, // misal default admin
        ]);

        Auth::login($user);
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }



    public function goDashboard()
    {
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            return view('layout-dashboard');
        }
    }
    public function logincheck(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]); // hasil true / false

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->id_level == 1) {
                return redirect()->route('dashboardAdmin');
            }
        }

        $pelanggan = \App\Models\Pelanggan::where('username', $credentials['username'])->first();
        if ($pelanggan && Hash::check($credentials['password'], $pelanggan->password)) {
            // Login manual pelanggan
            session(['pelanggan_id' => $pelanggan->id_pelanggan]);
            return redirect()->route('landingPage');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }
}
