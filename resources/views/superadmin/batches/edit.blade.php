@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1>Edit Pemilihan</h1>

            <form action="{{ route('superadmin.batches.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="vote_type">Type Pemilihan:</label>
                    <input type="text" name="vote_type" id="vote_type" class="form-control" value="{{ $batch->vote_type }}"
                        required>
                </div>
                <a href="/superadmin/batches" class="btn btn-red mb-2">Batal</a>
                <button type="submit" class="btn btn-yellow mr-2 mb-2">Update</button>
            </form>
        </div>
    </div>
@endsection
