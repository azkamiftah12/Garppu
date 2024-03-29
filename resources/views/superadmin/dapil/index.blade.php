@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5">Daerah Pilihan (DAPIL)</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    <h5>{!! session('success') !!}</h5>
                </div>
            @endif

            <div class="d-flex justify-content-center my-5">
                <a href="{{ route('superadmin.dapil.create') }}" class="btn btn-soft-blue">Tambah Dapil</a>
            </div>

            <div class="table-container" style="overflow-x: auto">
                <table class="table table-light table-striped my-3 text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Dapil</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dapils as $index => $dapil)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dapil->nama_dapil }}</td>
                                <td>
                                    <a href="{{ route('superadmin.dapil.edit', $dapil->id) }}"
                                        class="btn btn-yellow">Edit</a>

                                    <form action="{{ route('superadmin.dapil.destroy', $dapil->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red"
                                            onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DAPIL INI?')">Hapus</button>
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
