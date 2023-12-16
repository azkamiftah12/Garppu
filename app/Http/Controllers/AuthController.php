<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Dapil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            return $this->redirectBasedOnRole(Auth::user());
        }

        return redirect()->back()->withErrors(['nik' => 'kombinasi NIK dan Password salah']);
    }
    protected function redirectBasedOnRole(User $user)
    {
        if ($user->userRole === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->userRole === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function authenticated(Request $request, $user)
    {
        return $this->redirectBasedOnRole($user);
    }

    public function showSignupForm()
    {
        $batches = Batch::all();
        $dapils = Dapil::all();
        return view('auth.signup',['pageTitle' => "Daftar Akun"], compact('batches','dapils'));
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|string|digits:16|unique:userprofile',
            'nama' => 'required|string',
            'noTelp' => 'nullable|string',
            'password' => 'required|string|min:6',
            'kelurahan' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'no_tps' => 'nullable|string',
            'rekening_bank' => 'nullable|string',
            'no_rekening' => 'nullable|string',
            'id_dapil' => 'nullable|exists:dapil,id',
        ], [
            'nik.unique' => 'NIK sudah terdaftar. Masuk atau Login jika sudah mempunyai akun atau kontak admin jika butuh pertolongan. 0877-7670-0102',
            'nik.digits' => 'Format NIK Salah. NIK harus berjumlah 16 digit! Masukkan NIK anda yang sesua!',
        ]);

        $data['userRole'] = 'relawan'; // Set userRole to 'relawan'

        User::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'noTelp' => $data['noTelp'],
            'password' => Hash::make($data['password']),
            'userRole' => $data['userRole'],
            'kelurahan' => $data['kelurahan'],
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'no_tps' => $data['no_tps'],
            'rekening_bank' => $data['rekening_bank'],
            'no_rekening' => $data['no_rekening'],
            'id_dapil' => $data['id_dapil'],
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil terdaftar. Silahkan Masuk atau Login dengan cara mengisi formulir dibawah ini lalu pilih tombol masuk');
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
    public function profileku(){
        $user = Auth::user(); // Retrieve the authenticated user
        return view('profileku.index', compact('user'));
    }

public function resetPassword(Request $request, User $user)
{
    $newPassword = $request->input('new_password');

        // Update the user's password with the hashed new password
        $user->update(['password' => Hash::make($newPassword)]);


        return redirect()->route('admin.relawan')->with('success', 'Password reset successfully. New password: <strong>' . $newPassword . '</strong>');
}
public function superAdminResetPassword(Request $request, User $user)
{
    $newPassword = $request->input('new_password');

        // Update the user's password with the hashed new password
        $user->update(['password' => Hash::make($newPassword)]);


        return redirect()->route('superadmin.relawan')->with('success', 'Password reset successfully. New password: <strong>' . $newPassword . '</strong>');
}
public function userResetPassword(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|min:6',
        ]);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Ganti Password Gagal. Masukkan "Password Sekarang" dengan Password yang anda gunakan untuk login']);
        }

        // Update the user's password with the hashed new password
        $user->update(['password' => Hash::make($request->input('new_password'))]);

        return redirect()->route('profileku')->with('success', 'Password Berhasil dirubah.');
    }

}

