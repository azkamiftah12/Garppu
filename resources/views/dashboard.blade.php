@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            ini test ci/cd
            <h1>Hello, {{ $user->nama }}</h1>
            <p>NIK: {{ $user->nik }}</p>
            <p>No Telp: {{ $user->noTelp }}</p>
        </div>
    </div>
@endsection
