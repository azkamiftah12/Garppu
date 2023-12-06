<!-- resources/views/subrelawan/edit.blade.php -->

@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="container mt-3">
        <h1 class="my-5">Edit Anggota</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('subrelawan.update', $subRelawan->nikSubRelawan) }}" method="post">
            @csrf
            @method('PUT') {{-- This is important for Laravel to recognize the update method --}}
            <div class="mb-5">
                <label for="nikSubRelawan" class="form-label">NIK Anggota</label>
                <input type="text" class="form-control" id="nikSubRelawan" name="nikSubRelawan"
                    value="{{ $subRelawan->nikSubRelawan }}">
                <div id="nikSubRelawan" class="form-text">Masukkan NIK Anggota yang baru</div>
            </div>
            <div class="mb-5">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subRelawan->name }}"
                    required>
                <div id="nikSubRelawan" class="form-text">Masukkan Nama Anggota yang baru</div>
            </div>
            <div class="mb-5">
                <label for="telephone" class="form-label">Nomor Telephone</label>
                <input type="text" class="form-control" id="telephone" name="telephone"
                    value="{{ $subRelawan->telephone }}" required>
                <div id="nikSubRelawan" class="form-text">Masukkan Nomor Telepone Anggota yang baru</div>
            </div>
            {{-- <div class="mb-3">
                <label for="nik" class="form-label">Relasi</label>
                <select class="form-control" id="nik" name="nik" required readonly>
                    @foreach ($userProfiles as $user)
                        <option value="{{ $user->nik }}" {{ $user->nik == $subRelawan->nik ? 'selected' : '' }}>
                            {{ $user->nik }} - {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
            </div> --}}
            {{-- Add other form fields as needed --}}
            <button type="submit" class="btn btn-yellow mr-2 mb-2">Ubah Data</button>
            <a href="/subrelawan" class="btn btn-red mb-2">Batal</a>
        </form>
    </div>
@endsection
