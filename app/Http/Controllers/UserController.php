<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

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
        return view('layout-dashboard', ['totalUser'=>$totalUser, 'totalPelanggan'=>$totalPelanggan]);
    }




    public function registercheck(Request $request)
    {
        $validation = $request->validate([
            'username'   => 'required|unique:user',
            'password'   => 'required',
            'nama_admin' => 'required'
        ]);

        $user = User::create([
            'username'   => $validation['username'],
            'password'   => bcrypt($validation['password']),
            'nama_admin' => $validation['nama_admin'],
            'id_level'   => 1, // misal default admin
        ]);

        Auth::login($user);

        return redirect()->route('login');
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
        } else {
            Auth::logout();
            return back()->withErrors(['login' => 'Anda bukan admin']);
        }
    }

    return back()->withErrors(['login' => 'Username atau password salah']);
}

}
