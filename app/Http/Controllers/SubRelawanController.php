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
            'nikSubRelawan' => 'required|string|unique:sub_relawans',
            'name' => 'required|string',
            // Add validation rules for other columns as needed
        ], [
            'nikSubRelawan.unique' => 'NIK sudah terdaftar. Check NIK Kembali',
        ]);

        $user = Auth::user();

        // Automatically fill the 'nik' field with the user's 'nik'
        $request->merge(['nik' => $user->nik]);

        SubRelawan::create($request->all());

        return redirect()->route('subrelawan.index')->with('success', 'SubRelawan created successfully.');
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
            Rule::unique('sub_relawans')->ignore($nikSubRelawan, 'nikSubRelawan'),
        ],
        // Add validation rules for other columns as needed
    ], [
        'nikSubRelawan.unique' => 'NIK sudah terdaftar. Check NIK Kembali',
    ]);

    $subRelawan = SubRelawan::findOrFail($nikSubRelawan);
    $subRelawan->update([
        'name' => $request->input('name'),
        'nikSubRelawan' => $request->input('nikSubRelawan'),
        // Update other columns as needed
    ]);

    return redirect()->route('subrelawan.index')->with('success', 'SubRelawan updated successfully.');
}

    public function destroy($nikSubRelawan)
    {
        $subRelawan = SubRelawan::findOrFail($nikSubRelawan);
        $subRelawan->delete();

        return redirect()->route('subrelawan.index')->with('success', 'SubRelawan deleted successfully.');
    }
}

