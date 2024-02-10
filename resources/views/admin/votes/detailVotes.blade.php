@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Detail Data Votes {{ $relawan->nama }}</h1>

                    @foreach ($batches as $batch)
                        <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                            style="background-color: var(--color-white-brown)">


                            <h2 class="text-center">Vote {{ $batch->vote_type }}</h2>

                            {{-- C1 show start --}}
                            @php
                                $c1Found = false;
                                $nama = $relawan->nama;
                                $nik = $relawan->nik;
                            @endphp
                            @foreach ($C1DetailsAcc->where('batch_id', $batch->id) as $index => $detail)
                                @if ($detail->img_c1 && !$c1Found)
                                    <div class="d-flex justify-content-center my-5">
                                        <img src="{{ asset('storage/C1/' . basename($detail->img_c1)) }}" alt="C1 Image"
                                            class="img-fluid">
                                    </div>
                                    @php
                                        $c1Found = true;
                                        $nik = $detail->nik;
                                        $nama = $detail->userprofile->nama ?? '-';
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$c1Found)
                                <div class="text-center alert alert-danger my-5">
                                    <h3>Gambar C1 Belum Diinput.</h3>
                                </div>
                            @endif
                            {{-- C1 show End --}}

                            <div class="table-container" style="overflow-x: auto">
                                <table class="table table-light table-striped my-3 text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nomor Paslon</th>
                                            <th>Nama Paslon</th>
                                            <th>Jumlah Vote</th>
                                        </tr>
                                    </thead>
                                    @php
                                        // Filter votes for the current user
                                        $userVotes = $voteDetails->where('nik', $nik);
                                    @endphp
                                    <tbody>
                                        @foreach ($batch->candidates->sortBy('nomor_urut') as $index => $detail)
                                            <tr>
                                                <td>{{ $detail->nomor_urut ?? '-' }}</td>
                                                <td>{{ $detail->name }}</td>
                                                <td>

                                                    @php
                                                        // Sum up the jumlah_vote for the current candidate associated with the user's votes
$candidateVotes = $userVotes->where('candidate_id', $detail->id)->sum('jumlah_vote');
                                                    @endphp
                                                    {{ $candidateVotes }}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center my-3">
                        <a class="btn btn-red" href="{{ url('/admin/votesacc') }}">Kembali</a>
                    </div>

                    {{-- @if ($voteDetails->isNotEmpty())
                        @php $c1Found = false; @endphp
                        @foreach ($voteDetails as $detail)
                            @if ($detail->img_c1 && !$c1Found)
                                <div class="d-flex justify-content-center my-5">
                                    <img src="{{ asset('storage/C1/' . basename($detail->img_c1)) }}" alt="C1 Image"
                                        class="img-fluid">
                                </div>
                                @php $c1Found = true; @endphp
                            @endif
                        @endforeach
                        @if (!$c1Found)
                            <p>Gambar C1 tidak tersedia.</p>
                        @endif
                    @else
                        <p>Data tidak tersedia.</p>
                    @endif

                    <div class="table-container" style="overflow-x: auto">
                        <table class="datatable table table-light table-striped my-3 text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Relawan</th>
                                    <th>Nomor Paslon</th>
                                    <th>Nama Paslon</th>
                                    <th>Jumlah Vote</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voteDetails as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->nik }}</td>
                                        <td>{{ $detail->userprofile->nama ?? '-' }}</td>
                                        <td>{{ $detail->candidate->nomor_urut ?? '-' }}</td>
                                        <td>{{ $detail->candidate->name ?? '-' }}</td>
                                        <td>{{ $detail->jumlah_vote }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
