<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Batch;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $batches = Batch::all();
        return view('admin.candidates.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_urut' => 'required|integer',
            'batch_id' => 'required|exists:batches,id',
            'id_dapil' => 'required|exists:dapil,id',
        ]);

        Candidate::create($request->all());

        return redirect()->route('admin.candidates.index')->with('success', 'Paslon Berhasil ditambahkan');
    }
    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        $batches = Batch::all();
        return view('admin.candidates.edit', compact('candidate', 'batches'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_urut' => 'required|integer',
            'batch_id' => 'required|exists:batches,id',
            'id_dapil' => 'required|exists:dapil,id',
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
