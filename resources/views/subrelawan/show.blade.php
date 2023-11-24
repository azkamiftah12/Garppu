@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>SubRelawan Details</h2>

        <dl class="row">
            <dt class="col-sm-3">Nik SubRelawan</dt>
            <dd class="col-sm-9">{{ $subRelawan->nikSubRelawan }}</dd>

            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $subRelawan->name }}</dd>
            <dt class="col-sm-3">Relasi</dt>
            <dd class="col-sm-9">{{ $subRelawan->userprofile->nama ?? 'Unknown' }}</dd>


        </dl>
    </div>
@endsection
