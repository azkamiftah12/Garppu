@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
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
                            <th>RT</th>
                            <th>RW</th>
                            <th>kelurahan</th>
                            <th>No. TPS</th>
                            <th>rekening bank</th>
                            <th>No. Rekening</th>
                            <th>Type Pemilihan</th>
                            <th>Dapil</th>
                            <th>Waktu Input</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->nik ?? '-' }}</td>
                                <td>{{ $user->nama ?? '-' }}</td>
                                <td>{{ $user->noTelp ?? '-' }}</td>
                                <td>{{ $user->sub_relawans_count ?? '-' }}</td>
                                <td>{{ $user->rt ?? '-' }}</td>
                                <td>{{ $user->rw ?? '-' }}</td>
                                <td>{{ $user->kelurahan ?? '-' }}</td>
                                <td>{{ $user->no_tps ?? '-' }}</td>
                                <td>{{ $user->rekening_bank ?? '-' }}</td>
                                <td>{{ $user->no_rekening ?? '-' }}</td>
                                <td>{{ $user->dapil->batch->vote_type ?? ('-' ?? '-') }}</td>
                                <td>{{ $user->dapil->nama_dapil ?? ('-' ?? '-') }}</td>
                                <td>{{ $user->created_at ?? '-' }}</td>
                                <td>{{ $user->userRole ?? '-' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <!-- Add a confirmation dialog using JavaScript -->
                                        <button type="button" class="btn btn-soft-blue mr-1"
                                            onclick="confirmResetPassword('{{ $user->nik }}')">Reset Password</button>

                                        <form id="resetForm{{ $user->nik }}"
                                            action="{{ route('superadmin.reset-password', $user->nik) }}" method="post"
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
        </div>
    </div>
@endsection
