@extends('layouts.admin')

@section('content')
    <h1>Edit Candidate</h1>

    <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nomor_urut">Nomor Urut:</label>
            <input type="text" name="nomor_urut" id="nomor_urut" class="form-control" value="{{ $candidate->nomor_urut }}"
                required>
        </div>
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $candidate->name }}"
                required>
        </div>
        <a href="/admin/candidates" class="btn btn-red mb-2">Batal</a>
        <button type="submit" class="btn btn-yellow mr-2 mb-2">Update</button>
    </form>
@endsection
