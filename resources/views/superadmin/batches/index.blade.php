@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5">Batch Pemilihan</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    <h5>{!! session('success') !!}</h5>
                </div>
            @endif

            <div class="d-flex justify-content-center my-5">
                <a href="{{ route('superadmin.batches.create') }}" class="btn btn-soft-blue">Adakan Pemilihan</a>
            </div>

            <div class="table-container" style="overflow-x: auto">
                <table class="table table-light table-striped my-3 text-center">
                    <thead class="thead-dark">
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>No</th>
                            <th>Type Pemilihan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($batches as $index => $batch)
                            <tr>
                                {{-- <td>{{ $batch->id }}</td> --}}
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $batch->vote_type }}</td>
                                <td>
                                    <a href="{{ route('superadmin.batches.edit', $batch->id) }}"
                                        class="btn btn-yellow">Edit</a>
                                    <form action="{{ route('superadmin.batches.destroy', $batch->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red"
                                            onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS TYPE PEMILIHAN INI')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
