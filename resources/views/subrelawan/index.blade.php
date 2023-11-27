<!-- resources/views/subrelawan/index.blade.php -->

@extends('layouts.app')

@section('content')
    <style>
        .dataTables_length {
            margin-bottom: 20px;
        }
    </style>
    <div class="container mt-4">
        <h2>Daftar Anggota</h2>
        <div class="d-flex justify-content-center my-5">
            <a href="{{ route('subrelawan.create') }}" class="btn btn-soft-blue">Tambah Anggota</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-container" style="overflow-x: auto">
            <table class="table table-secondary my-3">
                <thead>
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
                                <a href="{{ route('subrelawan.show', $subRelawan->nikSubRelawan) }}"
                                    class="btn btn-soft-blue mb-1">Detail</a>
                                <a href="{{ route('subrelawan.edit', $subRelawan->nikSubRelawan) }}"
                                    class="btn btn-yellow mb-1">Edit</a>
                                <form action="{{ route('subrelawan.destroy', $subRelawan->nikSubRelawan) }}" method="post"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-red mb-1"
                                        onclick="return confirm('YAKIN INGIN MENGHAPUS DATA?')">Hapus</button>
                                </form>
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
