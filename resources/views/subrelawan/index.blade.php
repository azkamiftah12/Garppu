@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Daftar Anggota</h1>
        <div class="d-flex justify-content-center my-5">
            <a href="{{ route('subrelawan.create') }}" class="btn btn-soft-blue">Tambah Anggota</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <h5>{{ session('success') }}</h5>
            </div>
        @endif

        <div class="table-container" style="overflow-x: auto">
            <table class="table table-light table-striped my-3 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nik Anggota</th>
                        <th>Nama</th>
                        <th>No Telephone</th>
                        <th>Relasi</th>
                        <th>Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subRelawans as $index => $subRelawan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subRelawan->nikSubRelawan }}</td>
                            <td>{{ $subRelawan->name }}</td>
                            <td>{{ $subRelawan->telephone }}</td>
                            <td>{{ $subRelawan->userprofile->nama ?? 'Unknown' }}</td>
                            <td>
                                <div class="d-flex space-between justify-content-center">
                                    <a href="{{ route('subrelawan.show', $subRelawan->nikSubRelawan) }}"
                                        class="btn btn-soft-blue mr-1">Lihat</a>
                                    <a href="{{ route('subrelawan.edit', $subRelawan->nikSubRelawan) }}"
                                        class="btn btn-yellow mr-1">Edit</a>
                                    <form action="{{ route('subrelawan.destroy', $subRelawan->nikSubRelawan) }}"
                                        method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red mr-1"
                                            onclick="return confirm('YAKIN INGIN MENGHAPUS ANGGOTA INI?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@endsection
