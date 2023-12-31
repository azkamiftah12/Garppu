<?php

// app/Http/Controllers/SubRelawanController.php

namespace App\Http\Controllers;

use App\Models\SubRelawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SubRelawanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $subRelawans = SubRelawan::where('nik', $user->nik)->get();
        return view('subrelawan.index', compact('subRelawans'));
    }

    public function create()
    {
        $userProfiles = User::all();
        return view('subrelawan.create', compact('userProfiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nikSubRelawan' => 'required|string|digits:16|unique:sub_relawans',
            'name' => 'required|string',
            'telephone' => 'nullable|string',
        ], [
            'nikSubRelawan.unique' => 'NIK sudah terdaftar. Check NIK Kembali',
            'nik.digits' => 'Format NIK Salah. NIK harus berjumlah 16 digit! Masukkan NIK anggota anda yang sesua!',
        ]);

        $user = Auth::user();

        // Automatically fill the 'nik' field with the user's 'nik'
        $request->merge(['nik' => $user->nik]);

        SubRelawan::create($request->all());

        return redirect()->route('subrelawan.index')->with('success', 'Anggota Berhasil ditambahkan.');
    }

    public function show($nikSubRelawan)
    {
        $subRelawan = SubRelawan::with('userprofile')->findOrFail($nikSubRelawan);
        return view('subrelawan.show', compact('subRelawan'));
    }

    public function edit($nikSubRelawan)
    {
        $subRelawan = SubRelawan::findOrFail($nikSubRelawan);
        $userProfiles = User::all();
        return view('subrelawan.edit', compact('subRelawan', 'userProfiles'));
    }

    public function update(Request $request, $nikSubRelawan)
{
    $request->validate([
        'name' => 'required|string',
        'nikSubRelawan' => [
            'required',
            'string',
            'digits:16',
            Rule::unique('sub_relawans')->ignore($nikSubRelawan, 'nikSubRelawan'),
        ],
        'telephone' => 'nullable|string',
    ], [
        'nikSubRelawan.unique' => 'NIK sudah terdaftar. Check NIK Kembali',
        'nik.digits' => 'Format NIK Salah. NIK harus berjumlah 16 digit! Masukkan NIK anda yang sesua!',
    ]);

    $subRelawan = SubRelawan::findOrFail($nikSubRelawan);
    $subRelawan->update([
        'name' => $request->input('name'),
        'nikSubRelawan' => $request->input('nikSubRelawan'),
        'telephone' => $request->input('telephone'),
        // Update other columns as needed
    ]);

    return redirect()->route('subrelawan.index')->with('success', 'Ubah Data Anggota Berhasil.');
}

    public function destroy($nikSubRelawan)
    {
        $subRelawan = SubRelawan::findOrFail($nikSubRelawan);
        $subRelawan->delete();

        return redirect()->route('subrelawan.index')->with('success', 'Anggota Berhasil dihapus.');
    }
}

