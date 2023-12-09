<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubRelawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Retrieve the authenticated user
        return view('admin.dashboard', compact('user'));
    }
    public function allUsers()
{
    $users = User::withCount('subRelawans')->get();
    return view('admin.relawan', compact('users'));
}

public function allSubRelawans()
{
    $subRelawans = SubRelawan::all();
    return view('admin.anggota-relawan', compact('subRelawans'));
}

}
