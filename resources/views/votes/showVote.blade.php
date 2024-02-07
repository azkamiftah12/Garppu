@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1 class="mb-5 text-center">Silahkan Masukkan Hasil Voting di TPS anda!</h1>
                        <div class="col-md-12 p-4">
                            @if ($existingVote ?? false)
                                <div class="alert alert-success">
                                    <h3 class="text-center">Anda telah Menginput jumlah suara @foreach ($batch as $batchnya)
                                            <strong>
                                                {{ $batchnya->vote_type }}
                                            </strong>
                                        @endforeach di TPS
                                        anda.</h3>
                                </div>
                            @endif
                            <br>
                            <br>
                            <form method="post" action="{{ route('votes.store') }}">
                                @csrf
                                <div class="container">
                                    <div class="table-container" style="overflow-x: auto">
                                        <table class="table table-secondary my-3 text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Urut</th>
                                                    <th>Nama Paslon</th>
                                                    <th>Jumlah Suara</th>
                                                    @if ($existingVote ?? false)
                                                        <th>Menu</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($existingVote ?? false)
                                                    @foreach ($votes as $vote)
                                                        <tr>
                                                            <td>{{ $vote->candidate->nomor_urut }}</td>
                                                            <td>{{ $vote->candidate->name }}</td>
                                                            <td class="d-flex justify-content-center">
                                                                <input type="text" class="form-control text-center w-25"
                                                                    name="jumlah_vote_{{ $vote->id }}" pattern="[0-9]+"
                                                                    title="Hanya Bisa diinput Oleh Angka!" required
                                                                    @if ($existingVote) value="{{ $vote->jumlah_vote }}"
                                                                    readonly  {{-- Make the input readonly if an existing vote is found --}} @endif>
                                                            </td>
                                                            <td>
                                                                @if ($existingVote ?? false)
                                                                    <a href="{{ route('votes.edit', $vote->id) }}"
                                                                        class="btn btn-yellow mr-2">Edit</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @foreach ($candidates->sortBy('nomor_urut') as $candidate)
                                                        <tr>
                                                            <td>{{ $candidate->nomor_urut }}</td>
                                                            <td>{{ $candidate->name }}</td>
                                                            <td class="d-flex justify-content-center">
                                                                <input type="hidden" name="candidate_ids[]"
                                                                    value="{{ $candidate->id }}">
                                                                <input type="text" class="form-control text-center w-25"
                                                                    name="jumlah_vote_{{ $candidate->id }}"
                                                                    pattern="[0-9]+" title="Hanya Bisa diinput Oleh Angka!"
                                                                    required>
                                                            </td>
                                                            <td>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="container d-flex flex-column align-items-center justify-content-center mt-3"
                                    style="max-width: 250px">
                                    <a class="btn btn-red btn-block mb-2" href="{{ route('votes.index') }}">Cancel</a>
                                    <button type="submit" class="btn btn-soft-blue btn-block mb-2"
                                        @if ($existingVote ?? false) hidden @endif>Input Votes</button>
                                    @foreach ($batch as $batchnya)
                                        <a class="btn btn-yellow btn-block"
                                            href="{{ route('c1.create', $batchnya->id) }}">Input C1
                                            <br>
                                            <strong>
                                                {{ $batchnya->vote_type }}
                                            </strong>
                                        </a>
                                    @endforeach
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
