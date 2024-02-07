@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Votes Log</h1>

                    <div class="table-container" style="overflow-x: auto">
                        <table class="datatable table table-light table-striped my-3 text-center">
                            <thead class="thead-dark">
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
                                @foreach ($votes as $index => $vote)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vote->nik }}</td>
                                        <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                        <td>{{ $vote->candidate->nomor_urut }}</td>
                                        <td>{{ $vote->candidate->name ?? '-' }}</td>
                                        <td>{{ $vote->jumlah_vote }}</td>
                                        <td class="d-flex space-between">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
