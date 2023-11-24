<!-- resources/views/auth/signup.blade.php -->


@extends('layouts.authLayout') {{-- Assuming you have a default app layout --}}

@section('content')
    <form action="{{ route('signup') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="mb-3">
            <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
            <input class="form-control" id="nik" type="text" name="nik" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama</label>
            <input class="form-control" id="nama" type="text" name="nama" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="noTelp">Nomor Telepon</label>
            <input class="form-control" id="noTelp" type="text" name="noTelp">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password" required>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-login mt-3">Daftar</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <p>Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--color-yellow)">Login disini</a></p>
    </div>
@endsection
