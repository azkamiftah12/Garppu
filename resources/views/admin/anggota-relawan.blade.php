@extends('layouts.admin')

@section('content')
    <h1 class="my-5 text-center">Anggota Relawan</h1>
    <div class="table-container" style="overflow-x: auto">
        <table class="table table-secondary my-3">
            <thead>
                <tr>
                    <th>NIK SubRelawan</th>
                    <th>Nama</th>
                    <th>relasi</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($subRelawans as $subRelawan)
                    <tr>
                        <td>{{ $subRelawan->nikSubRelawan }}</td>
                        <td>{{ $subRelawan->name }}</td>
                        <td>{{ $subRelawan->userprofile->nama ?? 'Unknown' }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
