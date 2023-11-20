@extends('layouts.app')

@section('content')
    <div class="container container-default">
        <h1>Help</h1>
        <p>If you need assistance, please contact the admin:</p>
        <p>Contact Admin: 087886754470</p>
        <p>Current URL: {{ url()->current() }}</p>
    </div>
@endsection
