@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            @php
                $user = auth()
                    ->user()
                    ->load('dapil.batch');
            @endphp
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">
                        {{ $user->dapil->nama_dapil ?? 'Anda tidak terdaftar di dapil manapun!' }}</h1>
                    <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                        style="background-color: var(--color-white-brown)">
                        <h1 class="my-3 text-center">Paslon</h1>
                        @if (session('success'))
                            <div class="alert alert-success">
                                <h5>{!! session('success') !!}</h5>
                            </div>
                        @endif

                        <div class="d-flex justify-content-center my-5">
                            <a href="{{ route('admin.candidates.create') }}" class="btn btn-soft-blue">Tambah Paslon</a>
                        </div>

                        <div class="table-container" style="overflow-x: auto">
                            <table class="table table-light table-striped my-3 text-center">
                                <thead>
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <th>Nomor Urut</th>
                                        <th>Partai</th>
                                        <th>Nama Paslon</th>
                                        <th>Type Pemilu</th>
                                        <th>Dapil</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $index => $candidate)
                                        <tr>
                                            {{-- <td>{{ $index + 1 }}</td> --}}
                                            <td>{{ $candidate->nomor_urut }}</td>
                                            <td>{{ $candidate->partai->nama_partai ?? '-' }}</td>
                                            <td>{{ $candidate->name }}</td>
                                            <td>{{ $candidate->batch->vote_type ?? '-' }}</td>
                                            <td>{{ $candidate->dapil->nama_dapil }}</td>
                                            <td class="d-flex space-between">
                                                <a href="{{ route('admin.candidates.edit', $candidate->id) }}"
                                                    class="btn btn-yellow mr-2">Edit</a>

                                                <form action="{{ route('admin.candidates.destroy', $candidate->id) }}"
                                                    method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-red"
                                                        onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS PASLON INI?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
