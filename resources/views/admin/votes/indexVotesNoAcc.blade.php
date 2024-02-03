@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5 text-center">Votes yang Belum Di ACC</h1>

            <div class="table-container" style="overflow-x: auto">
                <table class="table table-secondary my-3 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Relawan</th>
                            <th>Nomor Paslon</th>
                            <th>Nama Paslon</th>
                            <th>Jumlah Vote</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($votesnoacc as $index => $vote)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $vote->nik }}</td>
                                <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                <td>{{ $vote->candidate->nomor_urut }}</td>
                                <td>{{ $vote->candidate->name ?? '-' }}</td>
                                <td>{{ $vote->jumlah_vote }}</td>
                                <td>
                                    <button type="button" class="btn btn-yellow mr-2 mb-2" data-toggle="modal" data-target="#confirmationModal{{ $vote->id }}">Validasi</button>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="confirmationModal{{ $vote->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel{{ $vote->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmationModalLabel{{ $vote->id }}">Konfirmasi Validasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Anda yakin ingin memvalidasi suara untuk <strong>{{ $vote->candidate->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <form method="POST" action="{{ route('admin.votes.accvalidasi', ['vote' => $vote]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_acc" value="1">
                                                    <button type="submit" class="btn btn-primary">Ya, Validasi</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
