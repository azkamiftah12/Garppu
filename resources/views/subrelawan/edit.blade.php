<!-- resources/views/subrelawan/edit.blade.php -->

@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="container mt-3">
        <h2>Edit SubRelawan</h2>
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
            <div class="mb-3">
                <label for="nikSubRelawan" class="form-label">NIK SubRelawan</label>
                <input type="text" class="form-control" id="nikSubRelawan" name="nikSubRelawan"
                    value="{{ $subRelawan->nikSubRelawan }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subRelawan->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">Relasi</label>
                <select class="form-control" id="nik" name="nik" required readonly>
                    @foreach ($userProfiles as $user)
                        <option value="{{ $user->nik }}" {{ $user->nik == $subRelawan->nik ? 'selected' : '' }}>
                            {{ $user->nik }} - {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Add other form fields as needed --}}
            <button type="submit" class="btn btn-soft-blue">Update</button>
            <a href="/subrelawan" class="btn btn-red">Cancel</a>
        </form>
    </div>
@endsection
