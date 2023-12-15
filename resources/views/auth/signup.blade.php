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
        <div class="form-group">
            <label class="form-label" for="id_dapil">Type Pemilihan:</label>
            <select name="id_dapil" id="id_dapil" class="form-control" required>
                @foreach ($dapils as $dapil)
                    <option value="{{ $dapil->id }}">{{ $dapil->nama_dapil }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
            <input class="form-control" id="nik" type="text" name="nik" required>
            <div id="nik" class="form-text">Masukkan NIK anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="kelurahan">Kelurahan</label>
            <input class="form-control" id="kelurahan" type="text" name="kelurahan" required>
            <div id="kelurahan" class="form-text">Masukkan kelurahan anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="rt">RT</label>
            <input class="form-control" id="rt" type="text" name="rt" required>
            <div id="rt" class="form-text">Masukkan RW anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="rw">RW</label>
            <input class="form-control" id="rw" type="text" name="rw" required>
            <div id="rw" class="form-text">Masukkan RW anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_tps">Nomor TPS</label>
            <input class="form-control" id="no_tps" type="text" name="no_tps" required>
            <div id="no_tps" class="form-text">Masukkan Nomor TPS anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama</label>
            <input class="form-control" id="nama" type="text" name="nama" required>
            <div id="nama" class="form-text">Masukkan Nama anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="noTelp">Nomor Telephone</label>
            <input class="form-control" id="noTelp" type="text" name="noTelp">
            <div id="noTelp" class="form-text">Masukkan Nomor Telepone anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="rekening_bank">Rekening Bank</label>
            <input class="form-control" id="rekening_bank" type="text" name="rekening_bank">
            <div id="rekening_bank" class="form-text">Masukkan Rekening anda</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_rekening">Nomor Rekening</label>
            <input class="form-control" id="no_rekening" type="text" name="no_rekening">
            <div id="no_rekening" class="form-text">Masukkan Nomor Rekening anda</div>
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
