@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Create SubRelawan</h2>

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
            <div class="mb-3">
                <label for="nikSubRelawan" class="form-label">Nik SubRelawan</label>
                <input type="text" class="form-control" id="nikSubRelawan" name="nikSubRelawan" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="/subrelawan" class="btn btn-danger">Cancel</a>
        </form>
    </div>
@endsection
