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


    public function getUsersRelawan()
{
    $user = Auth::user();
    $users = User::withCount('subRelawans')
                    ->where('userRole', 'relawan')
                    ->where('id_dapil', $user->id_dapil)
                    ->get();

    return view('admin.relawan', compact('users'));
}

public function allSubRelawans()
{
    $user = Auth::user();

    $subRelawans = SubRelawan::leftJoin('userprofile', 'sub_relawans.nik', '=', 'userprofile.nik')
        ->where('userprofile.userRole', 'relawan')
        ->where('userprofile.id_dapil', $user->id_dapil)
        ->get();
    return view('admin.anggota-relawan', compact('subRelawans'));
}

}
