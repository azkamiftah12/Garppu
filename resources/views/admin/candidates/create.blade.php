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
            <label class="form-label" for="partai_id">Pilih Partai Paslon:</label>
            <select name="partai_id" id="partaiDropdown" class="form-control" required>
                <option style="color: #888;" value="" disabled selected>Click untuk pilih Partai
                    Paslon</option>
                @foreach ($partais as $partai)
                    <option value="{{ $partai->id }}">{{ $partai->nama_partai }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <a href="/admin/candidates" class="btn btn-red mb-2">Batal</a>
        <button type="submit" class="btn btn-soft-blue mr-2 mb-2">Tambah Paslon</button>
    </form>
@endsection
