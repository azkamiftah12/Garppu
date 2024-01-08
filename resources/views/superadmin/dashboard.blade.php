@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5">Selamat Datang di Admin Page, {{ $user->nama }}</h1>
                    <h5>NIK: {{ $user->nik }}</h5>
                    <h5>No Telp: {{ $user->noTelp }}</h5>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('c1.create')}}">Add C1</a>
    </div>
@endsection
