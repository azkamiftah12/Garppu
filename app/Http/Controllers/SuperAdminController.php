<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubRelawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Retrieve the authenticated user
        return view('superadmin.dashboard', compact('user'));
    }
    public function allUsers()
{
    $users = User::with(['subRelawans', 'dapil.batch'])->withCount('subRelawans') // Eager load the relationships
                    ->where('userRole', 'relawan')
                    ->get();
    return view('superadmin.relawan', compact('users'));
}
    public function allAdmin()
{
    $users = User::withCount('subRelawans')->whereIn('userRole', ['admin', 'superadmin'])->get();
    return view('superadmin.admin.index', compact('users'));
}

public function allSubRelawans()
{
    $subRelawans = SubRelawan::all();
    return view('superadmin.anggota-relawan', compact('subRelawans'));
}

}
