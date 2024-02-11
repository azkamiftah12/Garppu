@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        <div class="container">

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">Votes Log</h1>

                    <div class="table-container" style="overflow-x: auto">
                        <table id="votesTable" class="datatable table table-light table-striped my-3 text-center">
                            <thead class="thead-dark">
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
                                @foreach ($votes as $index => $vote)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vote->nik }}</td>
                                        <td>{{ $vote->userprofile->nama ?? '-' }}</td>
                                        <td>{{ $vote->candidate->nomor_urut }}</td>
                                        <td>{{ $vote->candidate->name ?? '-' }}</td>
                                        <td>{{ $vote->jumlah_vote }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- menggunakan script tambahan karena developer tidak menemukan bug pada library data table yang tidak terpanggil hanya di page ini --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#votesTable').DataTable();
        });
    </script>
@endpush
