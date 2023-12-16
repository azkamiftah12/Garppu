@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center my-3">Selamat Datang di Admin Page</h1>
            @php
                $user = auth()
                    ->user()
                    ->load('dapil.batch');
            @endphp
            <h1 class="mb-5 text-center">{{ $user->dapil->batch->vote_type }} - {{ $user->dapil->nama_dapil }}</h1>
            <h5>Nama: {{ $user->nama }}</h5>
            <h5>NIK: {{ $user->nik }}</h5>
            <h5>No Telp: {{ $user->noTelp }}</h5>
        </div>
    </div>
@endsection
