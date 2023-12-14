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
            <div id="nik" class="form-text">Masukkan NIK anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama</label>
            <input class="form-control" id="nama" type="text" name="nama" required>
            <div id="nama" class="form-text">Masukkan Nama anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="noTelp">Nomor Telephone</label>
            <input class="form-control" id="noTelp" type="text" name="noTelp">
            <div id="nama" class="form-text">Masukkan Nomor Telepone anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password" required>
            <div id="nama" class="form-text">Masukkan Password anda</div>
            <div class="form-check mt-2">
                <input type="checkbox" onclick="togglePasswordVisibility()">
                <label class="form-check-label" for="togglePassword">Lihat isi password</label>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-login mt-3">Daftar</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <p>Sudah punya akun atau sudah daftar? silahkan <a href="{{ route('login') }}"
                style="color: var(--color-yellow); font-weight: 900">Login
                disini</a></p>
    </div>
@endsection
