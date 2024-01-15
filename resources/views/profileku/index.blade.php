@extends('../layouts.app') {{-- Assuming you have a default app layout --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        <h5>{{ session('success') }}</h5>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">
                        <h5>
                            {{ session('error') }}
                        </h5>
                    </div>
                @endif
                @error('old_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="card border-0 shadow rounded">
                    <div class="card-body p-5">
                        <h1 class="text-center mb-3">ProfileKU</h1>
                        <h5>Nama: {{ $user->nama }}</h5>
                        <h5>NIK: {{ $user->nik }}</h5>
                        <h5>No Telp: {{ $user->noTelp }}</h5>
                        <h5>Dapil anda: {{ $user->dapil->nama_dapil }}</h5>
                        <h5>Kelurahan: {{ $user->kelurahan ?? '-' }}</h5>
                        <h5>RT: {{ $user->rt ?? '-' }}</h5>
                        <h5>RW: {{ $user->rw ?? '-' }}</h5>
                        <h5>Nomor TPS: {{ $user->rw ?? '-' }}</h5>
                        <h5>Nama Bank: {{ $user->rekening_bank ?? '-' }}</h5>
                        <h5>Nomor Rekening Bank: {{ $user->no_rekening ?? '-' }}</h5>
                        <a href="{{ route('profile.edit.form') }}" class="btn btn-yellow my-4 mr-4">Edit Profile Saya</a>
                        <button type="button" class="btn btn-red my-4 mr-4" data-toggle="modal"
                            data-target="#exampleModal">
                            Ganti Password
                        </button>
                    </div>
                </div>
                {{-- modal start --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.reset-password', $user->nik) }}" method="post">
                                    @csrf
                                    @method('post')

                                    <div class="form-group">
                                        <label for="old_password">Password Sekarang</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control"
                                            required>
                                    </div>
                                    {{-- @if (session('error_message'))
                                <div class="alert alert-danger">
                                    {{ session('error_message') }}
                                </div>
                                @endif --}}

                                    <div class="form-group">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control"
                                            required>
                                    </div>

                                    <button type="button" class="btn btn-secondary mr-3"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal end --}}
            </div>
        </div>
    </div>
@endsection
