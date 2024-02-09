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

                                @php
                                    $labels = $batch->candidates->pluck('name')->toArray();
                                    $data = $batch->candidates
                                        ->pluck('votes')
                                        ->map(function ($votes) {
                                            return $votes->sum('jumlah_vote');
                                        })
                                        ->toArray();

                                    // Generate random colors for each bar
                                    $colors = [];
                                    for ($i = 0; $i < count($labels); $i++) {
                                        $colors[] = 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 0.8)';
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
                                </script>

                                @foreach ($batch->candidates->sortBy('nomor_urut') as $candidate)
                                    <div class="card border-0 shadow rounded mb-3">
                                        <div class="card-body">
                                            <h4 class="font-weight-bold">Nomor Urut: {{ $candidate->nomor_urut ?? '-' }}
                                            </h4>
                                            <h4 class="text-center font-weight-bold mb-5"
                                                style="color: var(--color-yellow)">{{ $candidate->name ?? '-' }}</h4>
                                            <h5 class="border-bottom pb-2">Partai:
                                                {{ $candidate->partai->nama_partai ?? '-' }}</h5>
                                            <h5>Total Suara: {{ $candidate->votes->sum('jumlah_vote') ?? '-' }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="card border-0 shadow rounded mb-3">
                                    <div class="card-body">
                                        <h4 class="text-center font-weight-bold mb-5" style="color: var(--color-yellow)">
                                            Total Suara Masuk</h4>
                                        <h5>Total Suara:
                                            {{ $batch->candidates->sum(function ($candidate) {return $candidate->votes->sum('jumlah_vote');}) }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
