@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1>Edit Candidate</h1>

            <form action="{{ route('votes.update', $vote->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Paslon:</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $vote->candidate->name }}" required disabled>
                </div>
                <div class="form-group">
                    <label for="jumlah_vote">Jumlah Suara:</label>
                    <input type="text" name="jumlah_vote" id="jumlah_vote" class="form-control"
                        value="{{ $vote->jumlah_vote }}" required>
                </div>
                <a href="/votes" class="btn btn-red mb-2">Batal</a>
                <button type="button" class="btn btn-yellow mr-2 mb-2" data-toggle="modal"
                    data-target="#confirmationModal">Update</button>
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
                    aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Update</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin merubah jumlah suara untuk <strong>{{ $vote->candidate->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-red" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-yellow">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
