@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h1 class="my-5 text-center">QuickCount {{ $user->dapil->nama_dapil }}</h1>

                    @foreach ($batches as $batch)
                        @if (!$batch->candidates->isEmpty())
                            <div class="border-0 shadow rounded col-md-12 p-4 mb-5"
                                style="background-color: var(--color-white-brown)">
                                <h1 class="text-center" style="color: var(--color-yellow)">Hasil QuickCount
                                    {{ $batch->vote_type }}</h1>
                                <canvas class="my-5" id="myChart_{{ $batch->id }}" width="400"
                                    height="200"></canvas>

                                {{-- <button class="btn btn-red"
                                    onclick="updateChartWithData({{ $batch->id }})">Fetch</button> --}}

                                @php
                                    $sortedCandidates = $batch->candidates->sortBy('nomor_urut');
                                    $labels = $sortedCandidates->pluck('name')->toArray();
                                    $data = $sortedCandidates
                                        ->pluck('votes')
                                        ->map(function ($votes) {
                                            return $votes->sum('jumlah_vote');
                                        })
                                        ->toArray();

                                    // Generate random colors for each bar. first 6 color is already generated
                                    $colors = ['rgba(184, 76, 125, 0.7)', 'rgba(80, 180, 123, 0.7)', 'rgba(134, 80, 166, 0.7)', 'rgba(104, 129, 216, 0.7)', 'rgba(193, 135, 57, 0.7)', 'rgba(184, 76, 62, 0.7)'];
                                    for ($i = 6; $i < count($sortedCandidates); $i++) {
                                        $colors[] = 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 0.7)';
                                    }
                                @endphp
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
                                    integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
                                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                <script>
                                    const ctx_{{ $batch->id }} = document.getElementById('myChart_{{ $batch->id }}');

                                    new Chart(ctx_{{ $batch->id }}, {
                                        type: 'bar',
                                        data: {
                                            labels: @json($labels),
                                            datasets: [{
                                                label: '{{ $batch->vote_type }} {{ $user->dapil->nama_dapil }}',
                                                data: @json($data),
                                                backgroundColor: @json($colors),
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    max: {{ $batch->candidates->sum(function ($candidate) {return $candidate->votes->sum('jumlah_vote');}) }}
                                                }
                                            },
                                            plugins: {
                                                datalabels: {
                                                    color: 'blue',
                                                    anchor: 'end',
                                                    align: 'end',
                                                    font: {
                                                        weight: 'bold',
                                                        size: 18,
                                                    }
                                                }
                                            }
                                        },
                                        plugins: [ChartDataLabels],
                                    });

                                    async function updateChartWithData(batchId) {
                                        const url = '{{ route('quickcount.data') }}';
                                        const response = await fetch(url);
                                        const datapoints = await response.json();

                                        // Map the fetched data to the sorted order of candidates based on nomor_urut
                                        const sortedCandidates = @json($sortedCandidates->pluck('id')->toArray());
                                        const sortedData = sortedCandidates.map(candidateId => {
                                            const candidateData = datapoints[batchId].find(candidate => candidate.id === candidateId);
                                            return candidateData ? candidateData.jumlah_vote : 0;
                                        });

                                        const ctx = document.getElementById('myChart_' + batchId);
                                        const chart = Chart.getChart(ctx);
                                        chart.data.datasets[0].data = sortedData;

                                        const maxVote = datapoints[batchId].reduce((sum, candidate) => sum + parseInt(candidate.jumlah_vote || 0),
                                            0);
                                        chart.options.scales.y.max = maxVote;
                                        chart.update();
                                    }
                                    setInterval(() => {
                                        updateChartWithData({{ $batch->id }});
                                    }, 10000);
                                </script>

                                <div class="row justify-content-center">
                                    @foreach ($batch->candidates->sortBy('nomor_urut') as $index => $candidate)
                                        <div class="col-md-4 mb-3">
                                            <div class="card border-0 shadow rounded h-100"
                                                style="background-color: {{ $colors[$loop->index] }}">
                                                <div class="card-body d-flex flex-column">
                                                    <div>
                                                        <h4 class="text-center font-weight-bold">Nomor Urut:
                                                            {{ $candidate->nomor_urut ?? '-' }}</h4>
                                                        <h4 class="text-center font-weight-bold my-4"
                                                            style="color: var(--indigo)">
                                                            {{ $candidate->name ?? '-' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="card-footer border-top border-bottom mb-3"
                                                    style="height: 110px;">
                                                    <h5 class="pb-2 mb-0 text-center">
                                                        {{ $candidate->partai->nama_partai ?? '-' }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>




                                {{--
                                <div class="card border-0 shadow rounded mb-3">
                                    <div class="card-body">
                                        <h4 class="text-center font-weight-bold mb-5" style="color: var(--color-yellow)">
                                            Total Suara Masuk</h4>
                                            <h5>Total Suara:
                                            {{ $batch->candidates->sum(function ($candidate) {return $candidate->votes->sum('jumlah_vote');}) }}
                                        </h5>
                                    </div>
                                </div>
                                --}}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
