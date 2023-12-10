@extends('layouts.admin')

@section('content')
    <h1>Tambahkan Paslon</h1>

    <form action="{{ route('admin.candidates.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nomor_urut">Nomor Urut:</label>
            <input type="text" name="nomor_urut" id="nomor_urut" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="batch_id">Type Pemilihan:</label>
            <select name="batch_id" id="batch_id" class="form-control" required>
                @foreach ($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->vote_type }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-soft-blue mr-2 mb-2">Tambah Paslon</button>
        <a href="/admin/candidates" class="btn btn-red mb-2">Batal</a>
    </form>
@endsection
