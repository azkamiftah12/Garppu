@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 class="my-5 text-center">Detail Kepemilikan NIK yang Belum Di ACC</h1>
            @if ($voteDetailsNoAcc->isNotEmpty())
                @php $c1Found = false; $nama = ''; $nik = ''; @endphp
                @foreach ($voteDetailsNoAcc as $index => $detail)
                    @if ($detail->img_c1 && !$c1Found)
                        <div class="d-flex justify-content-center my-5">
                            <img src="{{ asset('storage/C1/' . basename($detail->img_c1)) }}" alt="C1 Image" class="img-fluid">
                        </div>
                        @php $c1Found = true; $nik = $detail->nik; $nama = $detail->userprofile->nama ?? '-'; @endphp
                    @endif
                @endforeach
                @if (!$c1Found)
                    <p>Gambar C1 tidak tersedia.</p>
                @endif
            @else
                <p>Data tidak tersedia.</p>
            @endif

            <div class="table-container" style="overflow-x: auto">
                <table class="table table-secondary my-3 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Relawan</th>
                            <th>Nomor Paslon</th>
                            <th>Nama Paslon</th>
                            <th>Jumlah Vote</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voteDetailsNoAcc as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->nik }}</td>
                                <td>{{ $detail->userprofile->nama ?? '-' }}</td>
                                <td>{{ $detail->candidate->nomor_urut ?? '-' }}</td>
                                <td>{{ $detail->candidate->name ?? '-' }}</td>
                                <td>{{ $detail->jumlah_vote }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Validation Button and Modal -->
            <div class="text-center my-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validationModal">
                    Validasi
                </button>
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
                            Anda yakin ingin memvalidasi data dengan NIK {{ $nik }} dan nama relawan {{ $nama }}? Data yang sudah di simpan tidak dapat diubah, silahkan cek kembali !
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" onclick="updateStatusAcc()">Validasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateStatusAcc() {
            // Implement logic to update status_acc to 1 for data related to the viewed NIK
            var viewedNik = '{{ $nik }}';
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.votes.updateStatusAcc') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    nik: viewedNik,
                    // Tambahkan data lain yang diperlukan, jika ada
                },
                success: function(response) {
                    console.log(response);
                    $('#validationModal').modal('hide');
                    // Redirect to detailVotesNoAcc page
                    window.location.href = '{{ route('admin.votes', ['nik' => $nik]) }}';
                },
                error: function(error) {
                    console.error(error);
                    $('#validationModal').modal('hide');
                }
            });
        }
    </script>

@endsection
