@extends('layouts.admin')

@section('content')
    <h1 class="my-5">Paslon</h1>
    @if (session('success'))
        <div class="alert alert-success">
            <h5>{!! session('success') !!}</h5>
        </div>
    @endif

    <div class="d-flex justify-content-center my-5">
        <a href="{{ route('admin.candidates.create') }}" class="btn btn-soft-blue">Tambah Paslon</a>
    </div>

    <div class="table-container" style="overflow-x: auto">
        <table class="table table-secondary my-3 text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Urut</th>
                    <th>Nama Paslon</th>
                    <th>Batch</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $index => $candidate)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $candidate->nomor_urut }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->batch->vote_type }}</td>
                        <td>
                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-yellow">Edit</a>

                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST"
                                style="display: inline-block">
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
@endsection
