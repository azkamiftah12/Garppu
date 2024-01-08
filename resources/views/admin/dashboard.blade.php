@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <h1 class="text-center my-3">Selamat Datang di Admin Page</h1>
                @php
                    $user = auth()
                        ->user()
                        ->load('dapil.batch');
                @endphp
                <h1 class="mb-5 text-center">
                    {{-- {{ $user->dapil->batch->vote_type ?? '-' }} -  --}}
                    {{ $user->dapil->nama_dapil ?? 'Anda tidak terdaftar di dapil manapun.' }}
                </h1>
            </div>
        </div>
    </div>
    <div class="wrapper" style="background-color: var(--color-white-brown);">
        <div class="container">
            <div class="col-md-12 py-5"
                style="min-height: 100px; padding: 20px; margin: 20px 0px; color: var(--color-yellow)">
                <h1 class="text-center">Progress Relawan & Anggota Relawan</h1>
                <br>
                <h5>
                    Target Relawan/Koordinator TPS : {{ $targetRelawans }}
                </h5>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $progressRelawans }}%;"
                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Jumlah Relawan {{ $totalRelawans }} orang
                        ({{ $progressRelawans }}%)</div>
                </div>
                <br>
                <h5>
                    Target Anggota Relawan oleh Koordinator TPS : {{ $targetSubRelawans }}
                </h5>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progressSubRelawans }}%;"
                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Jumlah Anggota Relawan
                        {{ $totalSubRelawans }} orang
                        ({{ $progressSubRelawans }}%)</div>
                </div>
                <br>
                <h5>
                    Target Total Anggota Relawan : {{ $totaltargetSubRelawans }}
                </h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ $progresstotalSubRelawans }}%;"
                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Jumlah Anggota
                        Relawan {{ $totalSubRelawans }} orang
                        ({{ $progresstotalSubRelawans }}%)</div>
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <div class="wrapper">
        <div class="container">
            <h1 class="text-center">Profile Detail</h1>
            <h5>Nama: {{ $user->nama }}</h5>
            <h5>NIK: {{ $user->nik }}</h5>
            <h5>No Telp: {{ $user->noTelp }}</h5>
        </div>
    </div>
@endsection
