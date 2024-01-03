<!-- resources/views/auth/signup.blade.php -->


@extends('layouts.authLayout') {{-- Assuming you have a default app layout --}}

@section('content')
    <form autocomplete="off" action="{{ route('signup') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="form-group mb-3">
            <label class="form-label" for="id_dapil">Pilih Acara Pemilihan:</label>
            <select name="batch_id" id="batchDropdown" class="form-control" required>
                @foreach ($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->vote_type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="id_dapil">Pilih Dapil Pemilihan:</label>
            <select name="id_dapil" id="dapilDropdown" class="form-control" required>
                @foreach ($dapils as $dapil)
                    <option value="{{ $dapil->id }}">{{ $dapil->nama_dapil }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
            <input autocomplete="UserName" class="form-control" id="nik" type="text" name="nik" required
                placeholder="Masukkan NIK anda">
            <div id="nik" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="kelurahan">Kelurahan</label>
            <input class="form-control" id="kelurahan" type="text" name="kelurahan" required
                placeholder="Masukkan kelurahan anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="rt">RT</label>
            <input class="form-control" id="rt" type="text" name="rt" required
                placeholder="Masukkan RT anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="rw">RW</label>
            <input class="form-control" id="rw" type="text" name="rw" required
                placeholder="Masukkan RT anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_tps">Nomor TPS</label>
            <input class="form-control" id="no_tps" type="text" name="no_tps" required
                placeholder="Masukkan Nomor TPS anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama</label>
            <input class="form-control" id="nama" type="text" name="nama" required
                placeholder="Masukkan Nama anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="noTelp">Nomor Telephone</label>
            <input class="form-control" id="noTelp" type="text" name="noTelp" required
                placeholder="Masukkan Nomor Telephone anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="rekening_bank">Nama Bank</label>
            <input class="form-control" id="rekening_bank" type="text" name="rekening_bank" required
                placeholder="Masukkan Nama Bank anda, contoh: BCA, Mandiri, BRI">
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_rekening">Nomor Rekening</label>
            <input class="form-control" id="no_rekening" type="text" name="no_rekening" required
                placeholder="Masukkan Nomor Rekening anda">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password" required
                placeholder="Masukkan Password anda">
            <div id="nama" class="form-text"></div>
            <div class="form-check mt-2">
                <input type="checkbox" onclick="togglePasswordVisibility()">
                <label class="form-check-label" for="togglePassword">Lihat isi password</label>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-login mt-3">Daftar</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <p>Sudah punya akun atau sudah daftar? silahkan <a href="{{ route('login') }}"
                style="color: var(--color-yellow); font-weight: 900">Login
                disini</a></p>
    </div>
    <script>
        // jQuery function to filter dapils based on the selected batch
        $(document).ready(function() {
            // Cache the dapil dropdown for later use
            var dapilDropdown = $('#dapilDropdown');

            // Event handler for batch dropdown change
            $('#batchDropdown').change(function() {
                var batchId = $(this).val();

                // Clear dapil dropdown options
                dapilDropdown.empty();

                // Add a default option
                dapilDropdown.append('<option value="">Pilih Dapil Anda</option>');

                // Fetch dapils based on the selected batch via AJAX
                if (batchId) {
                    $.ajax({
                        url: '/get-dapils/' + batchId, // Replace with your actual route
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                // Populate dapil dropdown with fetched data
                                $.each(data, function(key, value) {
                                    dapilDropdown.append('<option value="' + value.id +
                                        '">' + value.nama_dapil + '</option>');
                                });
                            } else {
                                // If no dapils available, show a message
                                dapilDropdown.append(
                                    '<option value="" disabled selected>Tidak ada pilihan Dapil</option>'
                                );
                            }
                        }
                    });
                }
            });
        });

        // Function to toggle password visibility
        function togglePasswordVisibility() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');
        }
    </script>
@endsection
