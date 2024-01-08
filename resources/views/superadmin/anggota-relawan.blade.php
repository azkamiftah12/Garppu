@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5 text-center">All Anggota Relawan</h1>
            <div class="table-container" style="overflow-x: auto">
                <table class="table table-secondary my-3 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>relasi</th>
                            <th>Nama</th>
                            <th>NIK SubRelawan</th>
                            <th>Batch</th>
                            <th>Dapil</th>
                            <th>waktu Input</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subRelawans as $index => $subRelawan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $subRelawan->userprofile->nama ?? '-' }}</td>
                                <td>{{ $subRelawan->name }}</td>
                                <td>{{ $subRelawan->nikSubRelawan }}</td>
                                <td>{{ $subRelawan->userprofile->dapil->batch->vote_type ?? '-' }}</td>
                                <td>{{ $subRelawan->userprofile->dapil->nama_dapil ?? '-' }}</td>
                                <td>{{ $subRelawan->created_at }}</td>
                                <!-- Add more columns as needed -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
