<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\C1;
use App\Models\Batch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class C1Controller extends Controller
{
    public function index()
    {
        $c1Data = C1::all();
        return view('c1.index', compact('c1Data'));
    }

    public function create()
    {
        $batches = Batch::all();
        return view('c1.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'img_c1' => 'required|image|mimes:png,jpg,jpeg',
            'batch_id' => 'required|exists:batches,id'
        ]);

        $user = Auth::user();

        // Automatically fill the 'nik' field with the user's 'nik'
        $request->merge(['nik' => $user->nik]);


        $imgC1Path = $request->file('img_c1')->store('public/C1');
        $imgC1Path = str_replace('public/', 'storage/', $imgC1Path);


        C1::create([
            'nik' => $request->nik,
            'img_c1' => $imgC1Path,
            'batch_id' =>$request->batch_id
        ]);

        return redirect()->route('votes.index')->with('success', 'Data C1 berhasil disimpan.');
    }

    public function show(C1 $c1)
    {
        return view('c1.show', compact('c1'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $c1  = C1::where('nik', $user->nik)->findOrFail($id);
        return view('c1.edit', compact('c1'));
    }

    public function update(Request $request, $id)
{
    $c1 = C1::findOrFail($id);

    // Validasi input jika diperlukan
    $request->validate([
        'img_c1' => 'required|image|mimes:png,jpg,jpeg',
    ]);

    // Hapus gambar lama sebelum menyimpan yang baru
    Storage::delete(str_replace('storage/', 'public/', $c1->img_c1));

    // Simpan gambar baru
    $imgC1Path = $request->file('img_c1')->store('public/C1');
    $imgC1Path = str_replace('public/', 'storage/', $imgC1Path);

    // Update data di dalam database
    $c1->update([
        'img_c1' => $imgC1Path,
    ]);

    return redirect()->route('c1.index')->with('success', 'Data C1 berhasil diperbarui.');
}


    public function destroy(C1 $c1)
    {
        $c1->delete();

        return redirect()->route('c1.index')->with('success', 'Data C1 berhasil dihapus.');
    }
}
