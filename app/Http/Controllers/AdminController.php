<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\C1;
use App\Models\User;
use App\Models\SubRelawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

    public function VoteAcc(Request $request)
{
    // Mendapatkan nilai nik dari input pengguna atau data lainnya
    $nik = $request->input('nik'); // Anda mungkin perlu menyesuaikan ini sesuai dengan logika aplikasi Anda

    // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
    $votesacc = Vote::select('nik', DB::raw('COUNT(*) as totalSuara'))
                    ->where('status_acc', 1)
                    ->with('userprofile')
                    ->groupBy('nik')
                    ->get();

    // Ambil data user untuk digunakan dalam modal
    $detailuser = $this->DetailUser($nik); // Panggil fungsi DetailUser() untuk mendapatkan data detail pengguna beserta informasi suaranya

    // Gunakan data yang diperoleh dalam view
    return view('admin.votes.indexVotesAcc', compact('votesacc', 'detailuser'));
}

public function DetailUser($nik)
{
    // Ambil data pengguna berdasarkan nik
    $user = User::where('nik', $nik)->first();


    // Kembalikan data pengguna beserta informasi suaranya
    return $user;
}


 public function VoteNoAcc()
 {
     // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
     $votesnoacc = Vote::select('nik', DB::raw('COUNT(*) as totalSuara'))
                        ->where('status_acc', 0)
                        ->groupBy('nik')
                        ->get();

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

 public function detailVote($nik)
{
    // Ambil detail kepemilikan nik yang sesuai
    $voteDetails = Vote::where('votes.nik', $nik)
    ->where('votes.status_acc', 1)
    ->leftJoin('c1', 'votes.nik', '=', 'c1.nik')
    ->select(
        'votes.*',
        'c1.img_c1 as img_c1'
    )
    ->get();

    // Gunakan data yang diperoleh dalam view
    return view('admin.votes.detailVotes', compact('voteDetails'));
}

public function detailVotesNoAcc($nik)
{
    // Ambil detail kepemilikan nik yang sesuai dan belum divalidasi
    $voteDetailsNoAcc = Vote::where('votes.nik', $nik)
        ->where('votes.status_acc', 0)
        // ->leftJoin('c1', 'votes.nik', '=', 'c1.nik')
        // ->select(
        //     'votes.*',
        //     'c1.img_c1 as img_c1'
        // )
        ->get();
    $C1DetailsNoAcc = C1::where('C1.nik', $nik)
        ->get();
        $batches = Batch::with('candidates')->get();
        $relawan = User::where('nik' ,$nik)->first();
    return view('admin.votes.detailVotesNoAcc', compact('voteDetailsNoAcc',  'C1DetailsNoAcc', 'batches', 'relawan'));
}


public function c1File($nik)
{
    // Ambil detail kepemilikan nik yang sesuai
    $c1Details = C1::where('nik', $nik)->get();

    // Gunakan data yang diperoleh dalam view
    return view('admin.votes.detailVotesNoAcc', compact('voteDetails'));
}

public function updateStatusAcc(Request $request)
{
    try {
        $nik = $request->input('nik');

        // Implement logic to update status_acc to 1 for data related to the viewed NIK
        Vote::where('nik', $nik)->update(['status_acc' => 1]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error updating status.']);
    }
}
public function updateStatusTransfer(Request $request)
{
    try {
        $nik = $request->input('nik');

        // Implement logic to update status_acc to 1 for data related to the viewed NIK
        Vote::where('nik', $nik)->update(['status_acc' => 2]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error updating status.']);
    }
}



}


