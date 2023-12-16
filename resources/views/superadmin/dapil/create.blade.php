@extends('layouts.admin')

@section('content')
    <h1>Tambahkan Dapil</h1>

    <form action="{{ route('superadmin.dapil.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_dapil">Nama Dapil:</label>
            <input type="text" name="nama_dapil" id="nama_dapil" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="batch_id">Type Pemilihan:</label>
            <select name="batch_id" id="batch_id" class="form-control" required>
                @foreach ($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->vote_type }}</option>
                @endforeach
            </select>
        </div>
        <a href="/superadmin/dapil" class="btn btn-red mb-2">Batal</a>
        <button type="submit" class="btn btn-soft-blue mr-2 mb-2">Tambah Dapil</button>
    </form>
@endsection
