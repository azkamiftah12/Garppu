@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    @php
                        $user = auth()
                            ->user()
                            ->load('dapil.batch');
                    @endphp

                    <h1 class="my-5 text-center">{{ $user->dapil->batch->vote_type }} - {{ $user->dapil->nama_dapil }}</h1>
                    <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                        style="background-color: var(--color-white-brown)">
                        <h1 class="my-5 text-center">Anggota Relawan</h1>
                        <div class="table-container" style="overflow-x: auto">
                            <table class="datatable table table-light table-striped my-3 text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Relasi</th>
                                        <th>Nama</th>
                                        <th>NIK SubRelawan</th>
                                        <th>No Telephone</th>
                                        <th>Waktu Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subRelawans as $index => $subRelawan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $subRelawan->userprofile->nama ?? 'Unknown' }}</td>
                                            <td>{{ $subRelawan->name }}</td>
                                            <td>{{ $subRelawan->nikSubRelawan }}</td>
                                            <td>{{ $subRelawan->telephone }}</td>
                                            <td>{{ $subRelawan->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
