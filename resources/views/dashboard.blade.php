@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-5">Selamat Datang, {{ $user->nama }}</h1>
            <p>NIK: {{ $user->nik }}</p>
            <p>No Telp: {{ $user->noTelp }}</p>
        </div>
    </div>
@endsection
