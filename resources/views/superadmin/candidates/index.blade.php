@extends('layouts.admin')

@section('content')
    <h1 class="my-5 text-center">All Relawan</h1>
    @if (session('success'))
        <div class="alert alert-success">
            <h5>{!! session('success') !!}</h5>
        </div>
    @endif
    <div class="table-container" style="overflow-x: auto">
        <table class="table table-secondary my-3 text-center">
            <thead>
                <tr>
                    <td>No.</td>
                    <td>Nomor Urut</td>
                    <td>Partai</td>
                    <td>Nama Paslon</td>
                    <td>Type Pemilihan</td>
                    <td>Dapil</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $index => $candidate)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $candidate->nomor_urut }}</td>
                        <td>{{ $candidate->partai->nama_partai ?? '-' }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->batch->vote_type ?? '-' }}</td>
                        <td>{{ $candidate->dapil->nama_dapil }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
