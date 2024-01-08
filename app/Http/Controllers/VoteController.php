<?php

namespace App\Http\Controllers;

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

    public function createDPRD()
    {
        $user = Auth::user();
        $candidates = Candidate::where('batches.vote_type', 'PEMILU DPRD 2024') -> where('id_dapil', $user->id_dapil) -> get() ;
        return view('votes.create', compact('candidates'));
    }

    public function store(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'jumlah_vote' => 'required|integer',
        ]);

        // Simpan data ke dalam database
        Vote::create([
            'nik' => Auth::user()->nik,
            'candidate_id' => $request->input('candidate_id'),
            'jumlah_vote' => $request->input('jumlah_vote'),
        ]);

        return redirect()->route('votes.index')->with('success', 'Vote berhasil disimpan.');
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
