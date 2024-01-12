@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <h1 class="mb-5 text-center">QuickCount Page</h1>
                <div class="col-md-12" style="background-color: var(--color-white-brown)">
                    <h1 class="text-center">Hasil QuickCount </h1>
                    <a class="btn btn-soft-blue" href="{{ url('/votes/createDPRDVote') }}">Input Hasil Vote</a>
                </div>
            </div>
        </div>
    </div>
@endsection
