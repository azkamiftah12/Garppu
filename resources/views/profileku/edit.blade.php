@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-0 shadow rounded">
            <div class="card-body">
                <h1 class="text-center mb-4">Edit Profile Saya</h1>
                <form action="{{ route('profile.edit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="{{ old('nama', Auth::user()->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="noTelp">Nomor Telepon:</label>
                        <input type="text" name="noTelp" id="noTelp" class="form-control"
                            value="{{ old('noTelp', Auth::user()->noTelp) }}">
                    </div>
                    <div class="form-group">
                        <label for="kelurahan">Kelurahan:</label>
                        <input type="text" name="kelurahan" id="kelurahan" class="form-control"
                            value="{{ old('kelurahan', Auth::user()->kelurahan) }}">
                    </div>
                    <div class="form-group">
                        <label for="rt">RT:</label>
                        <input type="text" name="rt" id="rt" class="form-control"
                            value="{{ old('rt', Auth::user()->rt) }}">
                    </div>
                    <div class="form-group">
                        <label for="rw">RW:</label>
                        <input type="text" name="rw" id="rw" class="form-control"
                            value="{{ old('rw', Auth::user()->rw) }}">
                    </div>
                    <div class="form-group">
                        <label for="no_tps">Nomor TPS:</label>
                        <input type="text" name="no_tps" id="no_tps" class="form-control"
                            value="{{ old('no_tps', Auth::user()->no_tps) }}">
                    </div>
                    <div class="form-group">
                        <label for="rekening_bank">Nama Bank:</label>
                        <input type="text" name="rekening_bank" id="rekening_bank" class="form-control"
                            value="{{ old('rekening_bank', Auth::user()->rekening_bank) }}">
                    </div>
                    <div class="form-group">
                        <label for="no_rekening">Nomor Rekening:</label>
                        <input type="text" name="no_rekening" id="no_rekening" class="form-control"
                            value="{{ old('no_rekening', Auth::user()->no_rekening) }}">
                    </div>

                    <a href="/profileku" class="btn btn-red mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>

    </div>
@endsection
