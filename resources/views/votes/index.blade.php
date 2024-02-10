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
                                    <h1 class="text-center" style="color: var(--color-yellow)">Paslon
                                        {{ $batch->vote_type }}</h1>

                                    <div class="d-flex justify-content-center my-3">
                                        <a class="btn btn-soft-blue flex-fill" style="max-width: 350px"
                                            href="{{ route('votes.showVote', $batch->id) }}">Input Hasil Suara
                                            {{ $batch->vote_type }}</a>
                                    </div>
                                    <div class="row justify-content-center">
                                        @foreach ($batch->candidates->sortBy('nomor_urut') as $candidate)
                                            <div class="col-md-4 my-3">
                                                <div class="card border-0 shadow rounded h-100">
                                                    <div class="card-body d-flex flex-column">
                                                        <div>
                                                            <h4 class="text-center font-weight-bold">Nomor Urut:
                                                                {{ $candidate->nomor_urut ?? '-' }}</h4>
                                                            <h4 class="text-center font-weight-bold my-4"
                                                                style="color: var(--indigo)">
                                                                {{ $candidate->name ?? '-' }}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer border-top border-bottom mb-3"
                                                        style="height: 110px;">
                                                        <h5 class="pb-2 mb-0 text-center">
                                                            {{ $candidate->partai->nama_partai ?? '-' }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- @foreach ($batch->candidates->sortBy('nomor_urut') as $candidate)
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
                                    @endforeach --}}

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
