@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1>Edit Candidate</h1>

            <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nomor_urut">Nomor Urut:</label>
                    <input type="text" name="nomor_urut" id="nomor_urut" class="form-control"
                        value="{{ $candidate->nomor_urut }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="partai_id">Pilih Partai Paslon:</label>
                    <select name="partai_id" id="partaiDropdown" class="form-control" required>
                        <option value="" {{ is_null($candidate->partai_id) ? 'selected' : '' }}>Click untuk pilih
                            Partai
                            Paslon</option>
                        @foreach ($partais as $partai)
                            <option value="{{ $partai->id }}"
                                {{ $partai->id == $candidate->partai_id ? 'selected' : '' }}>
                                {{ $partai->nama_partai }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="batch_id">Pilih Type Pemilihan Paslon:</label>
                    <select name="batch_id" id="partaiDropdown" class="form-control" required>
                        <option value="" {{ is_null($candidate->batch_id) ? 'selected' : '' }}>Click untuk pilih
                            Type Pemilihan
                            Paslon</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" {{ $batch->id == $candidate->batch_id ? 'selected' : '' }}>
                                {{ $batch->vote_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $candidate->name }}"
                        required>
                </div>
                <a href="/admin/candidates" class="btn btn-red mb-2">Batal</a>
                <button type="submit" class="btn btn-yellow mr-2 mb-2">Update</button>
            </form>
        </div>
    </div>
@endsection
