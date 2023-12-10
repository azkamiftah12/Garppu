<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::all();
        return view('admin.batches.index', compact('batches'));
    }

    public function create()
    {
        return view('admin.batches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vote_type' => 'required|string|max:255',
        ]);

        Batch::create($request->all());

        return redirect()->route('admin.batches.index')->with('success', 'Batch Pemilihan Berhasil ditambahkan');
    }
    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        return view('admin.batches.edit', compact('batch'));
    }

    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'vote_type' => 'required|string|max:255',
        ]);

        $batch->update($request->all());

        return redirect()->route('admin.batches.index')->with('success', 'Batch updated successfully.');
    }

    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('admin.batches.index')->with('success', 'Batch deleted successfully.');
    }
}
