@extends('layouts.admin')

@section('content')
    <h1>Adakan Pemilihan</h1>

    <form action="{{ route('admin.batches.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="vote_type">Type Pemilihan:</label>
            <input type="text" name="vote_type" id="vote_type" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-soft-blue mr-2 mb-2">Buat</button>
        <a href="/admin/batches" class="btn btn-red mb-2">Batal</a>
    </form>
@endsection
