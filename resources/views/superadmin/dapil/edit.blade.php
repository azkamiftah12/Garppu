@extends('layouts.admin')

@section('content')
    <h1>Edit Dapil</h1>

    <form action="{{ route('superadmin.dapil.update', $dapil->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_dapil">Nama Dapil:</label>
            <input type="text" name="nama_dapil" id="nama_dapil" class="form-control" value="{{ $dapil->nama_dapil }}"
                required>
        </div>
        <div class="form-group">
            <label for="batch_id">Batch:</label>
            <select name="batch_id" id="batch_id" class="form-control" required>
                @foreach ($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $batch->id == $dapil->batch_id ? 'selected' : '' }}>
                        {{ $batch->vote_type }}</option>
                @endforeach
            </select>
        </div>
        <a href="/superadmin/dapil" class="btn btn-red mb-2">Batal</a>
        <button type="submit" class="btn btn-yellow mr-2 mb-2">Update</button>
    </form>
@endsection
