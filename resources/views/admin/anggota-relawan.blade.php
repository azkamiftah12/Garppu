@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            @php
                $user = auth()
                    ->user()
                    ->load('dapil.batch');
            @endphp

            <h1 class="my-5 text-center">{{ $user->dapil->batch->vote_type }} - {{ $user->dapil->nama_dapil }}</h1>
            <h1 class="my-5 text-center">Anggota Relawan</h1>
            <div class="table-container" style="overflow-x: auto">
                <table class="table table-secondary my-3 text-center">
                    <thead>
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
@endsection
