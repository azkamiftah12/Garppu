@extends('layouts.app') {{-- Assuming you have a default app layout --}}
@php
    use App\Models\Vote;
    use App\Models\C1;
@endphp

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1 class="mb-5 text-center">Halaman Voting</h1>

                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                <h5>{!! session('success') !!}</h5>
                            </div>
                        @endif

                        @foreach ($batches as $batch)
                            @php
                                $batchID = $batch->id;
                                $existingVote = Vote::where('nik', Auth::user()->nik)
                                    ->whereHas('candidate', function ($query) use ($batchID) {
                                        $query->where('batch_id', $batchID);
                                    })
                                    ->first();
                                $existingC1 = C1::where('nik', Auth::user()->nik)
                                    ->where('batch_id', $batchID)
                                    ->first();
                            @endphp

                            @if ($batch->candidates->isEmpty())
                            @else
                                <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                                    style="background-color: var(--color-white-brown)">
                                    <h1 class="text-center" style="color: var(--color-yellow)">Paslon
                                        {{ $batch->vote_type }}</h1>

                                    @if ($existingVote ?? false)
                                        <div class="d-flex justify-content-center my-3">
                                            <div class="card justify-content-center">
                                                <div class="card-header text-center">
                                                    <h5 class="font-weight-bold">Status</h5>
                                                </div>
                                                <div class="my-0 alert alert-success">
                                                    <h5 class="text-center">Anda telah Menginput jumlah
                                                        suara
                                                        <strong>
                                                            {{ $batch->vote_type }}
                                                        </strong>
                                                    </h5>
                                                </div>
                                                @if ($existingC1 ?? false)
                                                    <div class="my-0 alert alert-success">
                                                        <h5 class="text-center">Anda telah Menginput C1 <strong>
                                                                {{ $batch->vote_type }}
                                                            </strong></h5>
                                                    </div>
                                                @else
                                                    <div class="my-0 alert alert-warning">
                                                        <h5 class="text-center">Anda Belum Menginput C1 <strong>
                                                                {{ $batch->vote_type }}
                                                            </strong></h5>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center my-3">
                                            <a class="btn btn-soft-blue flex-fill" style="max-width: 350px"
                                                href="{{ route('votes.showVote', $batch->id) }}">Lihat <strong>Hasil Suara &
                                                    C1</strong> Saya Untuk
                                                {{ $batch->vote_type }}</a>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center my-3">
                                            <div class="card justify-content-center">
                                                <div class="card-header text-center">
                                                    <h5 class="font-weight-bold">Status</h5>
                                                </div>
                                                <div class="my-0 alert alert-warning">
                                                    <h5 class="text-center">Anda Belum Menginput Jumlah
                                                        Suara
                                                        <strong>
                                                            {{ $batch->vote_type }}
                                                        </strong>
                                                    </h5>
                                                </div>
                                                @if ($existingC1 ?? false)
                                                    <div class="my-0 alert alert-success">
                                                        <h5 class="text-center">Anda telah Menginput C1 <strong>
                                                                {{ $batch->vote_type }}
                                                            </strong></h5>
                                                    </div>
                                                @else
                                                    <div class="my-0 alert alert-warning">
                                                        <h5 class="text-center">Anda Belum Menginput C1 <strong>
                                                                {{ $batch->vote_type }}
                                                            </strong></h5>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center my-3">
                                            <a class="btn btn-soft-blue flex-fill" style="max-width: 350px"
                                                href="{{ route('votes.showVote', $batch->id) }}">Input <strong>
                                                    Hasil Suara & C1</strong>
                                                {{ $batch->vote_type }}</a>
                                        </div>
                                    @endif
                                    <div class="row justify-content-center">
                                        @foreach ($batch->candidates->sortBy('nomor_urut') as $candidate)
                                            <div class="col-md-4 my-3">
                                                <div class="card border-0 shadow rounded h-100">
                                                    <div class="card-body d-flex flex-column">
                                                        <div>
                                                            <h4 class="text-center font-weight-bold">Nomor Urut:
                                                                {{ $candidate->nomor_urut ?? '-' }}</h4>
                                                            <h4 class="text-center font-weight-bold my-4"
                                                                style="color: var(--yellow)">
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
