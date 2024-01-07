@extends('layouts.authLayout') {{-- Assuming you have a default app layout --}}

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>
                    {{ $errors->first() }}
                </h5>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <h5>
                    {{ session('success') }}
                </h5>
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
            <div class="d-flex justify-content-between">

                <div id="password" class="form-text">Masukkan Password</div>


                <div type="button" class="form-text" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Lupa Password?
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title" id="exampleModalLabel">Lupa Password</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Jika anda lupa password silahkan hubungi admin dibawah ini melalui Whatsapp</h5>
                                <div class="d-flex justify-content-center">

                                    <a href="https://wa.me/6287776700102?text=Halo%20admin,%20saya%20butuh%20bantuan%20anda%20mengenai%20password%20akun%20saya."
                                        class="btn btn-whatsapp my-3">
                                        <i class="fa fa-phone"></i> Hubungi Admin
                                    </a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal End-->
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" onclick="togglePasswordVisibility()">
                <label class="form-check-label" for="togglePassword">Lihat isi password</label>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-login mt-3">Masuk</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <p>Belum punya akun? <a href="{{ route('signup') }}" style="color: var(--color-yellow); font-weight: 900">Daftar
                disini</a></p>
    </div>
@endsection
