@extends('layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <h1 class="mb-5">Selamat Datang, {{ $user->nama }}</h1>
                <h1 class="mb-5">
                    {{-- {{ $user->dapil->batch->vote_type ?? '-' }} -  --}}
                    {{ $user->dapil->nama_dapil ?? 'Anda tidak terdaftar di dapil manapun.' }}
                </h1>
            </div>
        </div>
    </div>
    <div class="wrapper" style="background-color: var(--color-soft-white)">
        <div class="container">

            <div class="text-center">
                <div class="row">
                    <div class="col-12 my-5">
                        <h1>Pusat Bantuan</h1>
                    </div>
                    <div class="col-12 mb-3">
                        <h5>Jika anda mengalami kendala, Anda dapat menghubungi admin di nomor 0877-7670-0102</h5>
                    </div>
                    <div class="col-12 mb-5">
                        <a href="https://wa.me/6287776700102?text=Halo%20admin,%20saya%20butuh%20bantuan%20anda"
                            class="btn btn-whatsapp">
                            <i class="fa fa-phone"></i> HUBUNGI SEKARANG
                        </a>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
