@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Data Relawan Yang Sudah Ditransfer</h1>
                    <div class="table-container" style="overflow-x: auto">
                        <table class="datatable table table-light table-striped my-3 text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Relawan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votestransfer as $index => $vote)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vote->nik }}</td>
                                        <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                        <td>{{ 'SUDAH DITRANSFER' }}</td>
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
