@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Tambah Anggota</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subrelawan.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nikSubRelawan" class="form-label">Nik Anggota</label>
                <input type="text" class="form-control" id="nikSubRelawan" name="nikSubRelawan" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Nomor Telephone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-soft-blue me-2">Tambah</button>
            <a href="/subrelawan" class="btn btn-red">Batal</a>
        </form>
    </div>
@endsection
