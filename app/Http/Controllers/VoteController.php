<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        // Panggil metode quickCount untuk mendapatkan data kandidat dan jumlah vote
        $candidatesWithVotesDPRD = $this->quickCountDPRD();
        $batches = Batch::with('candidates')->get();


        // Gunakan data yang diperoleh dalam view
        return view('votes.index', compact('candidatesWithVotesDPRD', 'batches'));
    }
    public function show($batchID)
    {
        $user = Auth::user();
        $batch = Batch::where('id', $batchID)->get();
        $votes = Vote::where('nik', $user->nik)->whereHas('candidate', function ($query) use ($batchID) {
            $query->where('batch_id', $batchID);
        })->get();
        $candidates = Candidate::where('batch_id', $batchID) -> where('id_dapil', $user->id_dapil) -> get() ;
        $existingVote = Vote::where('nik', Auth::user()->nik)
            ->whereHas('candidate', function ($query) use ($batchID) {
                $query->where('batch_id', $batchID);
            })
            ->first();
        return view('votes.showVote', compact('votes', 'candidates', 'batch','existingVote'));
    }

    // public function createDPRDVote()
    // {
    //     $user = Auth::user();
    //     $votes = Vote::where('nik', $user->nik) -> get();
    //     // $VoteType= Batch::where('vote_type' , 'Pemilu DPRD 2024')->get('id');
    //     $candidates = Candidate::whereHas('batch', function($query) {
    //         $query->where('vote_type', 'Pemilu DPRD 2024');
    //     }) -> where('id_dapil', $user->id_dapil) -> get() ;
    //     // dd($candidates);
    //     return view('votes.createDPRDVote', compact('candidates', 'votes'));
    // }

    public function store(Request $request)
    {
    // Validasi input jika diperlukan
    $request->validate([
        'jumlah_vote_*' => 'required|integer|numeric|min:0', // Adjust the validation rule based on your needs
    ], [
        'jumlah_vote_*.*' => 'The votes must be a valid non-negative integer.',
    ]);

    // Get the authenticated user's ID
    $nik = Auth::user()->nik;

    // Loop through each candidate's vote
    foreach ($request->input('candidate_ids') as $candidateId) {
        $jumlahVote = $request->input('jumlah_vote_' . $candidateId);

        // Validate candidate ID if needed
        // $request->validate([
        //     'jumlah_vote_'.$candidateId => 'exists:candidates,id',
        // ]);

        // Simpan data ke dalam database
        Vote::create([
            'nik' => $nik,
            'candidate_id' => $candidateId,
            'jumlah_vote' => $jumlahVote,
            'status_acc' => 0,
        ]);
    }

    return redirect()->route('votes.index')->with('success', 'Votes berhasil disimpan.');
}

    public function quickCountDPRD()
    {
    // Ambil semua kandidat beserta jumlah vote
    $user = Auth::user();
    $candidatesWithVotesDPRD = Candidate::whereHas('batch', function($query) {
        $query->where('vote_type', 'Pemilu DPRD 2024');
    }) -> where('id_dapil', $user->id_dapil) -> with('votes')->get();

    return $candidatesWithVotesDPRD;
    }

    // public function calculateTotalVotesPerCandidate()
    // {
    //     // Ambil semua kandidat beserta jumlah vote
    //     $candidatesWithVotes = Candidate::whereHas('batch', function($query) {
    //         $query->where('vote_type', 'Pemilu DPRD 2024');
    //     })->with('votes')->get();

    //     // // Loop melalui setiap kandidat dan hitung total vote
    //     // foreach ($candidatesWithVotes as $candidate) {
    //     //     $totalVotes = $candidate->votes->sum('jumlah_vote');
    //     //     // Sekarang $totalVotes berisi jumlah vote untuk kandidat tertentu
    //     //     // Lakukan sesuatu dengan nilai ini, misalnya tampilkan atau simpan ke database
    //     //     // echo "Candidate Name: " . $candidate->name . " - Party: " . $candidate->nama_partai . " - Total Votes: " . $totalVotes . "<br>";
    //     // }
    // }


    public function edit($id)
    {
        $user = Auth::user();
        $vote  = Vote::where('nik', $user->nik)->findOrFail($id);
        return view('votes.edit', compact('vote'));
    }

    public function update(Request $request, $id)
    {
        $vote = Vote::findOrFail($id);
        // Validasi input jika diperlukan
        $request->validate([
            'jumlah_vote' => 'required|integer',
        ]);

        // Update data di dalam database
        $vote->update($request->all());

        return redirect()->route('votes.index')->with('success', 'Vote berhasil diperbarui.');
    }

    public function updateACC(Request $request, Vote $vote)
    {
    // Validasi input jika diperlukan
    $request->validate([
        'status_acc' => 'required|integer',
    ]);
    $vote->update([
        'status_acc' => 0,
    ]);

    return redirect()->route('votes.index')->with('success', 'Status ACC berhasil diperbarui.');
    }

    public function destroy(Vote $vote)
    {
        // Hapus data dari database
        $vote->delete();

        return redirect()->route('votes.index')->with('success', 'Vote berhasil dihapus.');
    }
}
