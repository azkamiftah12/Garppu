@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1 class="mb-5 text-center">Halaman Voting</h1>
                        @foreach ($batches as $batch)
                            @if ($batch->candidates->isEmpty())
                            @else
                                <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                                    style="background-color: var(--color-white-brown)">
                                    <h1 class="text-center" style="color: var(--color-yellow)">Hasil QuickCount
                                        {{ $batch->vote_type }}</h1>

                                    {{-- Tampilkan total hasil jumlah_vote per kandidat --}}
                                    {{-- @foreach ($candidatesWithVotesDPRD as $candidate)
                                <div class="mb-3">
                                    <h4>Nama Paslon: {{ $candidate->name ?? '-' }}</h4>
                                    <p>Partai: {{ $candidate->nama_partai ?? '-' }}</p>
                                    <p>Total Votes: {{ $candidate->votes->sum('jumlah_vote') ?? '-' }}</p>
                                </div>
                            @endforeach --}}


                                    @foreach ($batch->candidates->sortBy('nomor_urut') as $candidate)
                                        <div class="card border-0 shadow rounded mb-3">
                                            <div class="card-body">
                                                <h4 class="font-weight-bold">Nomor Urut: {{ $candidate->nomor_urut ?? '-' }}
                                                </h4>
                                                <h4 class="text-center font-weight-bold mb-5"
                                                    style="color: var(--color-yellow)">{{ $candidate->name ?? '-' }}
                                                </h4>
                                                <h5 class="border-bottom pb-2">Partai:
                                                    {{ $candidate->partai->nama_partai ?? '-' }}</h5>
                                                <h5>Total Suara: {{ $candidate->votes->sum('jumlah_vote') ?? '-' }}</h5>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="d-flex justify-content-center my-3">
                                        <a class="btn btn-soft-blue flex-fill" style="max-width: 350px"
                                            href="{{ route('votes.showVote', $batch->id) }}">Input Vote
                                            {{ $batch->vote_type }}</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
