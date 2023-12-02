<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['pageTitle' => "Masuk atau Login"]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Replace 'dashboard' with your desired route
        }

        return redirect()->back()->withErrors(['nik' => 'kombinasi NIK dan Password salah']);
    }

    public function showSignupForm()
    {
        return view('auth.signup',['pageTitle' => "Daftar Akun"]);
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|string|unique:userprofile',
            'nama' => 'required|string',
            'noTelp' => 'nullable|string',
            'password' => 'required|string|min:6',
        ], [
            'nik.unique' => 'NIK sudah terdaftar. Masuk atau Login jika sudah mempunyai akun atau kontak admin jika butuh pertolongan. 0877-7245-0026',
        ]);

        $data['userRole'] = 'relawan'; // Set userRole to 'relawan'

        User::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'noTelp' => $data['noTelp'],
            'password' => Hash::make($data['password']),
            'userRole' => $data['userRole'],
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil terdaftar. Silahkan Masuk atau Login');
    }
    public function logout()
{
    Auth::logout();

    return redirect('/login');
}
    public function dashboard()
    {
        $user = Auth::user(); // Retrieve the authenticated user
        return view('dashboard', compact('user'));
    }
}

