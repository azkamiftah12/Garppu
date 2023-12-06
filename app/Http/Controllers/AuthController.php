<?php

namespace App\Http\Controllers;

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
        }

        return redirect()->route('dashboard');
    }
    public function authenticated(Request $request, $user)
    {
        return $this->redirectBasedOnRole($user);
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
    // AdminController.php

public function resetPassword(Request $request, User $user)
{
    $newPassword = $request->input('new_password');

        // Update the user's password with the hashed new password
        $user->update(['password' => Hash::make($newPassword)]);

        // Display the new password to the admin (you might want to send it via email instead)
        return redirect()->route('admin.relawan')->with('success', 'Password reset successfully. New password: <strong>' . $newPassword . '</strong>');
}
public function userResetPassword(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|min:6',
        ]);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Ganti Password Gagal! "Password Sekarang" tidak cocok. Masukkan "Password Sekarang" dengan Password yang anda gunakan untuk login']);
        }

        // Update the user's password with the hashed new password
        $user->update(['password' => Hash::make($request->input('new_password'))]);

        return redirect()->route('profileku')->with('success', 'Password Berhasil dirubah.');
    }

}

