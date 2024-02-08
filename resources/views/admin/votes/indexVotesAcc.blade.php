@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Votes yang Sudah Di ACC</h1>

                    <div class="table-container" style="overflow-x: auto">
                        <table class="datatable table table-light table-striped my-3 text-center">
                            <thead class="thead-dark">
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
                                                class="btn btn-info mr-2">Detail Votes</a>
                                            <!-- Validation Button and Modal -->
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary validationBtn"
                                                    data-toggle="modal" data-target="#validationModal"
                                                    data-nik="{{ $vote->nik }}"
                                                    data-nama="{{ $vote->userprofile->nama ?? '-' }}"
                                                    data-noTelp="{{ $vote->userprofile->where('nik', $vote->nik)->first()->noTelp ?? '-' }}"
                                                    data-dapil="{{ $vote->userprofile->where('nik', $vote->nik)->first()->dapil->nama_dapil ?? '-' }}"
                                                    data-kelurahan="{{ $vote->userprofile->where('nik', $vote->nik)->first()->kelurahan ?? '-' }}"
                                                    data-rt="{{ $vote->userprofile->where('nik', $vote->nik)->first()->rt ?? '-' }}"
                                                    data-rw="{{ $vote->userprofile->where('nik', $vote->nik)->first()->rw ?? '-' }}"
                                                    data-nomorTps="{{ $vote->userprofile->where('nik', $vote->nik)->first()->nomor_tps ?? '-' }}"
                                                    data-namaBank="{{ $vote->userprofile->where('nik', $vote->nik)->first()->rekening_bank ?? '-' }}"
                                                    data-nomorRekeningBank="{{ $vote->userprofile->where('nik', $vote->nik)->first()->no_rekening ?? '-' }}">
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
        </div>
    </div>
    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel"
        aria-hidden="true">
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
                            <h5>No Telp: <span id="modalNoTelp"></span></h5>
                            <h5>Dapil anda: <span id="modalDapil"></span></h5>
                            <h5>Kelurahan: <span id="modalKelurahan"></span></h5>
                            <h5>RT: <span id="modalRt"></span></h5>
                            <h5>RW: <span id="modalRw"></span></h5>
                            <h5>Nomor TPS: <span id="modalNomorTps"></span></h5>
                            <h5>Nama Bank: <span id="modalNamaBank"></span></h5>
                            <h5>Nomor Rekening Bank: <span id="modalNomorRekeningBank"></span></h5>
                        </div>
                    </div>
                    <h4 class="text-center mt-3">Anda yakin ingin Konfirmasi Vote dengan NIK <strong
                            id="modalNikConfirm"></strong> dan nama relawan <strong id="modalNamaConfirm"></strong>? Data
                        yang
                        sudah disimpan tidak dapat diubah, silahkan cek kembali!</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-red" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateStatusAcc()">Konfirmasi
                        Vote</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.validationBtn').click(function() {
                var nik = $(this).data('nik');
                var nama = $(this).data('nama');
                var noTelp = $(this).data('noTelp');
                var dapil = $(this).data('dapil');
                var kelurahan = $(this).data('kelurahan');
                var rt = $(this).data('rt');
                var rw = $(this).data('rw');
                var nomorTps = $(this).data('nomorTps');
                var namaBank = $(this).data('namaBank');
                var nomorRekeningBank = $(this).data('nomorRekeningBank');

                $('#modalNik').text(nik);
                $('#modalNikConfirm').text(nik);
                $('#modalNama').text(nama);
                $('#modalNamaConfirm').text(nama);
                $('#modalNoTelp').text(noTelp);
                $('#modalDapil').text(dapil);
                $('#modalKelurahan').text(kelurahan);
                $('#modalRt').text(rt);
                $('#modalRw').text(rw);
                $('#modalNomorTps').text(nomorTps);
                $('#modalNamaBank').text(namaBank);
                $('#modalNomorRekeningBank').text(nomorRekeningBank);
            });
        });
    </script>
@endsection
