@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5 text-center">Votes yang Sudah Di ACC</h1>

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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($votesacc as $index => $vote)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $vote->nik }}</td>
                                <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                <td>{{ $vote->candidate->nomor_urut }}</td>
                                <td>{{ $vote->candidate->name ?? '-' }}</td>
                                <td>{{ $vote->jumlah_vote }}</td>
                                <td class="d-flex space-between">
                                    <!-- Add your action buttons here if needed -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
