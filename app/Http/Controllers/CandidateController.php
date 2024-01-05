<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Batch;
use App\Models\Dapil;
use App\Models\Partai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $partais = Partai::all();
        return view('admin.candidates.create', compact('partais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_urut' => 'required|integer',
            'partai_id' => 'nullable|exists:partais,id',
        ]);

        // Mendapatkan user saat ini yang sedang login
        $user = Auth::user();

        // $request->merge(['id_dapil' => $user->id_dapil]);

        // Menambahkan data candidate dengan id_dapil dari user
        Candidate::create([
            'name' => $request->input('name'),
            'nomor_urut' => $request->input('nomor_urut'),
            'id_dapil' => $user->id_dapil,
            'partai_id' => $request['partai_id'],
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Paslon Berhasil ditambahkan');
    }
    public function edit($id)
    {
        $partais = Partai::all();
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidates.edit', compact('candidate', 'partais'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_urut' => 'required|integer',
            'partai_id' => 'nullable|exists:partais,id',
        ]);

        $candidate->update($request->all());

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully.');
    }

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
