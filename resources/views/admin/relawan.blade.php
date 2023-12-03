@extends('layouts.admin')

@section('content')
    <h1 class="my-5 text-center">Relawan</h1>
    <div class="table-container" style="overflow-x: auto">
        <table class="table table-secondary my-3">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->noTelp }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
