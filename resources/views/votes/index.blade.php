@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1 class="mb-5 text-center">QuickCount Page</h1>
                        <div class="border-0 shadow rounded col-md-12 p-4" style="background-color: var(--color-white-brown)">
                            <h1 class="text-center">Hasil QuickCount</h1>

                            {{-- Tampilkan total hasil jumlah_vote per kandidat --}}
                            @foreach ($candidatesWithVotesDPRD as $candidate)
                                <div class="mb-3">
                                    <h4>Nama Paslon: {{ $candidate->name }}</h4>
                                    <p>Partai: {{ $candidate->nama_partai }}</p>
                                    <p>Total Votes: {{ $candidate->votes->sum('jumlah_vote') }}</p>
                                </div>
                            @endforeach

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
