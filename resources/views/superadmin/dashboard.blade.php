@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5">Selamat Datang di Admin Page, {{ $user->nama }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
