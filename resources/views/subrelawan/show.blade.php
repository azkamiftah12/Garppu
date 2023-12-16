@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Anggota Detail</h1>

        <dl class="row my-5">
            <dt class="col-sm-3">Nik Anggota</dt>
            <dd class="col-sm-9">: {{ $subRelawan->nikSubRelawan }}</dd>
            <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">: {{ $subRelawan->name }}</dd>
            <dt class="col-sm-3">Nomor Telephone</dt>
            <dd class="col-sm-9">: {{ $subRelawan->telephone ?? '-' }}</dd>
            <dt class="col-sm-3">Relasi</dt>
            <dd class="col-sm-9">: {{ $subRelawan->userprofile->nama ?? 'Unknown' }}</dd>
        </dl>
    </div>
@endsection
