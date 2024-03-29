@extends('layouts.app')

@section('content')
    @php

    @endphp
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1 class="text-center">Input C1</h1>
                        @if ($existingC1 ?? false)
                            <div class="alert alert-success mt-5">
                                <h3 class="text-center">Anda telah Menginput C1</h3>
                            </div>
                            <div class="d-flex justify-content-center my-5">
                                <img src="{{ asset('storage/C1/' . basename($existingC1->img_c1)) }}" alt="C1 Image"
                                    class="img-fluid">
                            </div>
                        @endif
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        <form action="{{ $existingC1 ? route('c1.update', $existingC1->id) : route('c1.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($existingC1)
                                @method('PUT') {{-- If updating, include the PUT method --}}
                            @endif
                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control @error('img_c1') is-invalid @enderror"
                                    name="img_c1">
                                <!-- error message untuk title -->
                                @error('img_c1')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label" for="batch_id" hidden>Pilih Type Pemilihan:</label>
                                <select name="batch_id" id="batchDropdown" class="form-control" required hidden>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->vote_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a class="btn btn-red mr-2 mb-2" href="{{ route('votes.index') }}">Kembali</a>
                            @if ($existingC1)
                                <button type="submit" class="btn btn-yellow mr-2 mb-2">Ubah
                                    C1</button>
                            @else
                                <button type="submit" class="btn btn-soft-blue mr-2 mb-2">Simpan
                                    C1</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
