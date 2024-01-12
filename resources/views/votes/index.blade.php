@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1 class="mb-5 text-center">QuickCount Page</h1>
                        <div class="border-0 shadow rounded col-md-12 p-4" style="background-color: var(--color-white-brown)">
                            <h1 class="text-center">Hasil QuickCount </h1>
                            <div class="d-flex justify-content-center my-3">
                                <a class="btn btn-soft-blue" href="{{ url('/votes/createDPRDVote') }}">Input Hasil Vote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
