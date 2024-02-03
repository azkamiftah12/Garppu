@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5 text-center">Detail Data Votes</h1>

             @if ($voteDetails->isNotEmpty())
                @php $c1Found = false; @endphp
                @foreach ($voteDetails as $detail)
                    @if ($detail->img_c1 && !$c1Found)
                        <div class="d-flex justify-content-center my-5">
                            <img src="{{ asset('storage/C1/' . basename($detail->img_c1)) }}" alt="C1 Image" class="img-fluid">
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
                <table class="table table-secondary my-3 text-center">
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
            </div>
        </div>
    </div>
@endsection
