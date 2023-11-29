@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="my-5" style="font-weight: 900">Tambah Anggota</h1>

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
            <div class="mb-5">
                <label for="nikSubRelawan" class="form-label">NIK Anggota</label>
                <input type="text" class="form-control" id="nikSubRelawan" name="nikSubRelawan" required>
                <div id="nikSubRelawan" class="form-text">Masukkan NIK Anggota</div>
            </div>
            <div class="mb-5">
                <label for="name" class="form-label">Nama Anggota</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div id="nikSubRelawan" class="form-text">Masukkan Nama Anggota</div>
            </div>
            <div class="mb-5">
                <label for="telephone" class="form-label">Nomor Telephone Anggota</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
                <div id="nikSubRelawan" class="form-text">Masukkan Nomor Telepone Anggota</div>
            </div>

            <button type="submit" class="btn btn-soft-blue me-2 mb-2">Tambah</button>
            <a href="/subrelawan" class="btn btn-red mb-2">Batal</a>
        </form>
    </div>
@endsection
