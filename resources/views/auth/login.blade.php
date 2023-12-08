@extends('layouts.authLayout') {{-- Assuming you have a default app layout --}}

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3">
            <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
            <div id="nik" class="form-text">Masukkan NIK anda</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div id="password" class="form-text">Masukkan Password anda</div>
            <div class="form-check mt-2">
                <input type="checkbox" onclick="togglePasswordVisibility()">
                <label class="form-check-label" for="togglePassword">Lihat isi password</label>
            </div>
        </div>
        {{-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
</div> --}}
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-login mt-3">Masuk</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <p>Belum punya akun? <a href="{{ route('signup') }}" style="color: var(--color-yellow); font-weight: 900">Daftar
                disini</a></p>
        <a href="https://wa.me/6287772450026?text=Halo%20saya%20tertarik%20dengan%20layanan%20Anda"
            class="btn btn-whatsapp mt-5">
            <i class="fa fa-phone"></i> Hubungi Admin
        </a>
    </div>
@endsection
