<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dapil;
use App\Models\Batch;

class DapilController extends Controller
{
    public function index()
    {
        $dapils = Dapil::all();
        return view('superadmin.dapil.index', compact('dapils'));
    }

    public function create()
    {
        $batches = Batch::all();
        return view('superadmin.dapil.create', compact('batches'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama_dapil' => 'required',
            'provinsi' => 'required',
            'batch_id' => 'required|exists:batches,id',
        ]);

        // Simpan data Dapil ke database
        Dapil::create($request->all());

        // Redirect ke halaman index atau ke halaman lain sesuai kebutuhan
        return redirect()->route('superadmin.dapil.index')->with('success', 'Dapil Berhasil ditambahkan');
    }
    public function edit($id)
    {
        $dapil = Dapil::findOrFail($id);
        $batches = Batch::all();
        return view('superadmin.dapil.edit', compact('dapil', 'batches'));
    }

    public function update(Request $request, $id)
    {
        // Temukan dapil berdasarkan ID
        $dapil = Dapil::findOrFail($id);
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama_dapil' => 'required',
            'provinsi' => 'required',
            'batch_id' => 'required|exists:batches,id',
        ]);
        // Update data Dapil di database
        $dapil->update($request->all());

        // Redirect ke halaman index atau ke halaman lain sesuai kebutuhan
        return redirect()->route('superadmin.dapil.index')->with('success', 'Dapil updated successfully.');
    }

    public function destroy($id)
    {
        // Temukan dapil berdasarkan ID
        $dapil = Dapil::findOrFail($id);

        // Hapus dapil dari database
        $dapil->delete();

        // Redirect ke halaman index atau ke halaman lain sesuai kebutuhan
        return redirect()->route('superadmin.dapil.index')->with('success', 'Dapil Berhasil dihapus');
    }
    // Metode lainnya seperti show, edit, update, destroy, dll. sesuai kebutuhan
}
