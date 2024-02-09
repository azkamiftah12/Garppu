@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Votes Belum Terkonfirmasi</h1>
                    <div class="table-container" style="overflow-x: auto">
                        <table class="datatable table table-light table-striped my-3 text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Relawan</th>
                                    <th>Paslon Terinput</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votesnoacc as $index => $vote)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vote->nik }}</td>
                                        <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                        <td>{{ $vote->totalSuara }}</td>
                                        <td>
                                            <a href="{{ route('admin.votes.noacc.detail', ['nik' => $vote->nik]) }}"
                                                class="btn btn-soft-blue">Detail</a>
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
