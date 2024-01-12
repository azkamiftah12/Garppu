@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <h1 class="mb-5 text-center">Silahkan Masukkan Hasil Voting di TPS anda!</h1>
                <div class="col-md-12 p-4" style="background-color: var(--color-white-brown)">
                    <h1 class="text-center">Masukkan Vote</h1>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($candidates as $candidate)
                                            <tr>
                                                <td>{{ $candidate->nomor_urut }}</td>
                                                <td>{{ $candidate->name }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <input type="hidden" name="candidate_ids[]"
                                                        value="{{ $candidate->id }}">
                                                    <input type="text" class="form-control text-center w-25"
                                                        name="jumlah_vote_{{ $candidate->id }}" pattern="[0-9]+"
                                                        title="Hanya Bisa diinput Oleh Angka!" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a class="btn btn-red mr-2" href="{{ route('votes.index') }}">Cancel</a>
                        <button type="submit" class="btn btn-soft-blue">Input Votes</button>
                        <a class="btn btn-yellow" href="{{ route('c1.create') }}">Input C1</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
