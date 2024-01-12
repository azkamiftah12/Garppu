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
        $votes = Vote::all();
        return view('votes.index', compact('votes'));
    }

    public function createDPRDVote()
    {
        $user = Auth::user();
        // $VoteType= Batch::where('vote_type' , 'Pemilu DPRD 2024')->get('id');
        $candidates = Candidate::whereHas('batch', function($query) {
            $query->where('vote_type', 'Pemilu DPRD 2024');
        }) -> where('id_dapil', $user->id_dapil) -> get() ;
        // dd($candidates);
        return view('votes.createDPRDVote', compact('candidates'));
    }

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
        ]);
    }

    return redirect()->route('votes.index')->with('success', 'Votes berhasil disimpan.');
}


    public function show(Vote $vote)
    {
        return view('votes.show', compact('vote'));
    }

    public function edit(Vote $vote)
    {
        $candidates = Candidate::all();
        return view('votes.edit', compact('vote', 'candidates'));
    }

    public function update(Request $request, Vote $vote)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'jumlah_vote' => 'required|integer',
        ]);

        // Update data di dalam database
        $vote->update([
            'candidate_id' => $request->input('candidate_id'),
            'jumlah_vote' => $request->input('jumlah_vote'),
        ]);

        return redirect()->route('votes.index')->with('success', 'Vote berhasil diperbarui.');
    }

    public function destroy(Vote $vote)
    {
        // Hapus data dari database
        $vote->delete();

        return redirect()->route('votes.index')->with('success', 'Vote berhasil dihapus.');
    }
}
