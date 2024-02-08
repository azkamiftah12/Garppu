@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Vote belum Dikonfirmasi {{ $relawan->nama }}</h1>
                    @foreach ($batches as $batch)
                        <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                            style="background-color: var(--color-white-brown)">


                            <h2 class="text-center">Vote {{ $batch->vote_type }}</h2>

                            {{-- C1 show start --}}
                            @php
                                $c1Found = false;
                                $nama = $relawan->nama;
                                $nik = $relawan->nik;
                            @endphp
                            @foreach ($C1DetailsNoAcc->where('batch_id', $batch->id) as $index => $detail)
                                @if ($detail->img_c1 && !$c1Found)
                                    <div class="d-flex justify-content-center my-5">
                                        <img src="{{ asset('storage/C1/' . basename($detail->img_c1)) }}" alt="C1 Image"
                                            class="img-fluid">
                                    </div>
                                    @php
                                        $c1Found = true;
                                        $nik = $detail->nik;
                                        $nama = $detail->userprofile->nama ?? '-';
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$c1Found)
                                <div class="text-center alert alert-danger my-5">
                                    <h3>Gambar C1 Belum Diinput.</h3>
                                </div>
                            @endif
                            {{-- C1 show End --}}

                            <div class="table-container" style="overflow-x: auto">
                                <table class="table table-light table-striped my-3 text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nomor Paslon</th>
                                            <th>Nama Paslon</th>
                                            <th>Jumlah Vote</th>
                                        </tr>
                                    </thead>
                                    @php
                                        // Filter votes for the current user
                                        $userVotes = $voteDetailsNoAcc->where('nik', $nik);
                                    @endphp
                                    <tbody>
                                        @foreach ($batch->candidates->sortBy('nomor_urut') as $index => $detail)
                                            <tr>
                                                <td>{{ $detail->nomor_urut ?? '-' }}</td>
                                                <td>{{ $detail->name }}</td>
                                                <td>

                                                    @php
                                                        // Sum up the jumlah_vote for the current candidate associated with the user's votes
$candidateVotes = $userVotes->where('candidate_id', $detail->id)->sum('jumlah_vote');
                                                    @endphp
                                                    {{ $candidateVotes }}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <!-- Validation Button and Modal -->
                    <div class="text-center my-3">
                        <button type="button" class="btn btn-soft-blue" data-toggle="modal" data-target="#validationModal">
                            Validasi
                        </button>
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
                                    Anda yakin ingin Konfirmasi Vote dengan NIK <strong>
                                        {{ $nik }}
                                    </strong>
                                    dan nama relawan
                                    <strong>
                                        {{ $nama }}
                                    </strong>? Data yang sudah di simpan tidak dapat diubah, silahkan cek kembali
                                    !
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-red" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-soft-blue" onclick="updateStatusAcc()">Konfirmasi
                                        Vote</button>
                                </div>
                            </div>
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
