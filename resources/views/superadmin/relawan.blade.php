@extends('layouts.admin')

@section('content')
    <h1 class="my-5 text-center">All Relawan</h1>
    @if (session('success'))
        <div class="alert alert-success">
            <h5>{!! session('success') !!}</h5>
        </div>
    @endif
    <div class="table-container" style="overflow-x: auto">
        <table class="table table-secondary my-3 text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Jumlah Anggota</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->noTelp }}</td>
                        <td>{{ $user->sub_relawans_count }}</td>
                        <td>{{ $user->userRole }}</td>
                        <td>
                            <div class="d-flex">
                                <!-- Add a confirmation dialog using JavaScript -->
                                <button type="button" class="btn btn-soft-blue mr-1"
                                    onclick="confirmResetPassword('{{ $user->nik }}')">Reset Password</button>

                                <form id="resetForm{{ $user->nik }}"
                                    action="{{ route('admin.reset-password', $user->nik) }}" method="post"
                                    style="display: none;">
                                    @csrf
                                    @method('post')

                                    <!-- Add a hidden input field for the new password -->
                                    <input type="hidden" name="new_password"
                                        value="{{ Illuminate\Support\Str::random(10) }}">

                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmResetPassword(nik) {
            if (confirm('Are you sure you want to reset the password?')) {
                document.getElementById('resetForm' + nik).submit();
            }
        }
    </script>
@endsection
