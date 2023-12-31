@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1>Adakan Pemilihan</h1>

            <form action="{{ route('superadmin.batches.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="vote_type">Type Pemilihan:</label>
                    <input type="text" name="vote_type" id="vote_type" class="form-control" required>
                </div>
                <a href="/superadmin/batches" class="btn btn-red mb-2">Batal</a>
                <button type="submit" class="btn btn-soft-blue mr-2 mb-2">Buat</button>
            </form>
        </div>
    </div>
@endsection
