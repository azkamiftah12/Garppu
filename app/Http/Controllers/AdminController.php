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
        $user = Auth::user();

        $relawans = User::withCount('subRelawans')
        ->where('userRole', 'relawan')
        ->where('id_dapil', $user->id_dapil)
        ->get();

        $subRelawans = SubRelawan::leftJoin('userprofile', 'sub_relawans.nik', '=', 'userprofile.nik')
        ->where('userprofile.id_dapil', $user->id_dapil)
        ->get();

        $totalRelawans = $relawans->count();
        $totalSubRelawans = $subRelawans->count();

        $targetRelawans = 1000;
        $targetSubRelawans = $totalRelawans * 50;
        $totaltargetSubRelawans = 1000 * 50;

        $progressRelawans = $totalRelawans/$targetRelawans*100;
        $progressSubRelawans = $totalSubRelawans/$targetSubRelawans*100;
        $progresstotalSubRelawans = $totalSubRelawans/$totaltargetSubRelawans*100;

        return view('admin.dashboard', compact('user', 'relawans', 'totalRelawans', 'totalSubRelawans', 'targetSubRelawans', 'targetRelawans', 'progressRelawans', 'progressSubRelawans', 'totaltargetSubRelawans', 'progresstotalSubRelawans'));
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
