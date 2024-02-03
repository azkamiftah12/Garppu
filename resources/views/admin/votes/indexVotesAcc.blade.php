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
                            <th>Detail Data</th> {{-- Tambah kolom Detail --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($votesacc as $index => $vote)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $vote->nik }}</td>
                                <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.votes.detail', ['nik' => $vote->nik]) }}" class="btn btn-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
