@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Votes yang Sudah Di ACC</h1>

                    <div class="table-container" style="overflow-x: auto">
                        <table class="datatable table table-light table-striped my-3 text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Relawan</th>
                                    <th>Detail Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votesacc as $index => $vote)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vote->nik }}</td>
                                        <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                        <td class="d-flex space-between justify-content-center">
                                            <a href="{{ route('admin.votes.detail', ['nik' => $vote->nik]) }}"
                                                class="btn btn-primary mr-2">Detail Votes</a>
                                            <!-- Validation Button and Modal -->
                                            <div class="text-center">
                                                <button type="button" class="btn btn-soft-blue validationBtn"
                                                    data-toggle="modal" data-target="#validationModal"
                                                    data-nik="{{ $vote->nik }}"
                                                    data-nama="{{ $vote->userprofile->nama ?? '-' }}"
                                                    data-telp="{{ $vote->userprofile->noTelp ?? '-' }}"
                                                    data-dapil="{{ $vote->userprofile->where('nik', $vote->nik)->first()->dapil->nama_dapil ?? '-' }}"
                                                    data-kelurahan="{{ $vote->userprofile->kelurahan ?? '-' }}"
                                                    data-rt="{{ $vote->userprofile->where('nik', $vote->nik)->first()->rt ?? '-' }}"
                                                    data-rw="{{ $vote->userprofile->where('nik', $vote->nik)->first()->rw ?? '-' }}"
                                                    data-no_tps="{{ $vote->userprofile->where('nik', $vote->nik)->first()->no_tps ?? '-' }}"
                                                    data-rekening_bank="{{ $vote->userprofile->where('nik', $vote->nik)->first()->rekening_bank ?? '-' }}"
                                                    data-no_rekening="{{ $vote->userprofile->where('nik', $vote->nik)->first()->no_rekening ?? '-' }}">
                                                    Transfer
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Validation Modal -->
            <div class="modal fade" id="validationModal" tabindex="-1" role="dialog"
                aria-labelledby="validationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="validationModalLabel">Konfirmasi Update</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="userData" class="card border-0 shadow rounded">
                                <div class="card-body p-5">
                                    <h1 class="text-center mb-3">Profile Relawan</h1>
                                    <h5>Nama: <span id="modalNama"></span></h5>
                                    <h5>NIK: <span id="modalNik"></span></h5>
                                    <h5>No Telepon: <span id="modalTelp"></span></h5>
                                    <!-- Menambahkan ini untuk no telepon -->
                                    <h5>Dapil: <span id="modalDapil"></span></h5>
                                    <h5>Kelurahan: <span id="modalKelurahan"></span></h5>
                                    <h5>RT: <span id="modalRt"></span></h5>
                                    <h5>RW: <span id="modalRw"></span></h5>
                                    <h5>Nomor TPS: <span id="modalnomorTps"></span></h5>
                                    <h5>Nama Bank: <span id="modalNamaBank"></span></h5>
                                    <h5>Nomor Rekening Bank: <span id="modalNomorRekeningBank"></span></h5>
                                </div>
                            </div>
                            <p class="text-center mt-3">Anda yakin ingin Konfirmasi Vote dengan NIK <span
                                    id="modalNik"></span> dan nama relawan <span id="modalNama"></span>? Data
                                yang
                                sudah disimpan tidak dapat diubah, silahkan cek kembali!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-soft-blue transferBtn">Transfer
                                Vote</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var nik; // Declare nik variable outside the click function
                    $('.validationBtn').click(function() {
                        var nama = $(this).data('nama');
                        nik = $(this).data('nik'); // Assign the value to the nik variable
                        var telp = $(this).data('telp');
                        var dapil = $(this).data('dapil');
                        var kelurahan = $(this).data('kelurahan');
                        var rt = $(this).data('rt');
                        var rw = $(this).data('rw');
                        var no_tps = $(this).data('no_tps');
                        var rekening_bank = $(this).data('rekening_bank');
                        var no_rekening = $(this).data('no_rekening');

                        $('#modalNama').text(nama);
                        // $('#modalNamaConfirm').text(nama);
                        $('#modalNik').text(nik);
                        // $('#modalNikConfirm').text(nik);
                        $('#modalTelp').text(telp);
                        $('#modalDapil').text(dapil);
                        $('#modalKelurahan').text(kelurahan);
                        $('#modalRt').text(rt);
                        $('#modalRw').text(rw);
                        $('#modalnomorTps').text(no_tps);
                        $('#modalNamaBank').text(rekening_bank);
                        $('#modalNomorRekeningBank').text(no_rekening);
                    });

                    $('.transferBtn').click(function() {
                        updateStatusTransfer(nik); // Pass the nik value to the function
                    });

                    function updateStatusTransfer(viewedNik) {
                        // Implement logic to update status_acc to 1 for data related to the viewed NIK
                        var viewedNik = viewedNik
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.votes.updateStatusTransfer') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                nik: viewedNik,
                                // Tambahkan data lain yang diperlukan, jika ada
                            },
                            success: function(response) {
                                console.log(response);
                                $('#validationModal').modal('hide');
                                // Redirect to detailVotesNoAcc page
                                window.location.href = '{{ route('admin.votes', ['nik' => '']) }}' + viewedNik;
                            },
                            error: function(error) {
                                console.error(error);
                                $('#validationModal').modal('hide');
                            }
                        });
                    }
                });
            </script>
        @endsection
