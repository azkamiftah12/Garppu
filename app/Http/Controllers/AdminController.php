<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubRelawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Vote;


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

// public function AllVote()
//     {
//         // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
//         $votes = Vote::all();

//         // Gunakan data yang diperoleh dalam view
//         return view('admin.votes.index', compact('votes'));
//     }

public function AllVote()
    {
        // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
        $votes = Vote::all();
        // Gunakan data yang diperoleh dalam view
        return view('admin.votes.index', compact('votes'));
    }

public function VoteAcc()
    {
        // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
        $votesacc = Vote::where('status_acc', 1)->get();

        // Gunakan data yang diperoleh dalam view
        return view('admin.votes.indexVotesAcc', compact('votesacc'));
 }

 public function VoteNoAcc()
 {
     // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
     $votesnoacc = Vote::where('status_acc', 0)->get();

     // Gunakan data yang diperoleh dalam view
     return view('admin.votes.indexVotesNoAcc', compact('votesnoacc'));
 }

 public function accvalidasi(Request $request, Vote $vote)
 {
     // Validasi input jika diperlukan
     $request->validate([
         'status_acc' => 'required|integer',
     ]);

     // Update status_acc sesuai dengan input form
     $vote->update([
         'status_acc' => $request->input('status_acc'),
     ]);

     // Tambahkan pesan sukses dan arahkan kembali ke tampilan admin.votes.indexVotesNoAcc
     $votesnoacc = Vote::where('status_acc', 0)->get();

     return view('admin.votes.indexVotesNoAcc', compact('votesnoacc'))->with('success', 'Status ACC berhasil diperbarui.');
 }


}


