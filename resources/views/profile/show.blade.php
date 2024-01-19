@extends('layouts.dashboard')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('dashboard-content')
    <div class="card mb-2 p-4 bg-black text-white">
        @if ($user)
            <div class="row">
                <div class="d-flex flex-rows">
                    @isset($user->profile)
                        @if ($user->profile && $user->profile->profile_picture)
                            <img src="data:image/png;base64, {{ $user->profile->profile_picture }}" alt="Profile Picture"
                                class="img-fluid rounded-circle mb-2" style="width: 150px; height: 150px;">
                        @endif
                    @else
                        <img src="https://vivaldi.com/wp-content/themes/vivaldicom-theme/img/new/icon.webp" alt="Profile Picture"
                            class="img-fluid rounded-circle mb-2" style="width: 150px; height: 150px;">
                    @endisset
                    <div class="mx-4">
                        @isset($user->profile)
                            <h3>{{ $user->profile->first_name }} {{ $user->profile->last_name }}</h3>
                            <p>{{ '@' . $user->username }}</p>
                            <p>{{ $user->profile->bio }}</p>
                        @else
                            <h3>User {{ $user->id }}</h3>
                            <p>{{ '@' . $user->username }}</p>
                        @endisset
                    </div>
                </div>
            </div>
        @endif

        @isset($user->profile)
            @if (count($user->scores) > 0)
                <hr>
                <canvas id="scoreChart"
                    data-data="{{ json_encode(
                        $user->scores->map(function ($score) {
                            $timeParts = explode(' ', $score->score);
                            $seconds = isset($timeParts[0]) ? floatval($timeParts[0]) : 0;
                            $milliseconds = isset($timeParts[2]) ? floatval($timeParts[2]) / 1000 : 0;
                            $microseconds = isset($timeParts[4]) ? floatval($timeParts[4]) / 1000000 : 0;
                            $totalSeconds = $seconds + $milliseconds + $microseconds;
                            return [
                                'race' => $score->race_name,
                                'score' => $totalSeconds,
                                'date' => $score->created_at->format('Y-m-d'),
                            ];
                        }),
                    ) }}"></canvas>
                <h3>Scores:</h3>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Race Name</th>
                            <th scope="col">Score</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->scores->sortByDesc('created_at') as $score)
                            <tr>
                                <td>
                                    <button class="btn btn-danger race-button" data-race="{{ $score->race_name }}">
                                        {{ ucwords(str_replace('-', ' ', $score->race_name)) }}
                                    </button>
                                </td>
                                <td>{{ $score->score }}</td>
                                <td>{{ $score->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endisset
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const scoreChartCanvas = document.getElementById('scoreChart');
        const data = JSON.parse(scoreChartCanvas.dataset.data);
        let chart;

        function updateChart(race) {
            console.log('Updating chart for race:', race); // Debugging line

            const filteredData = data.filter(item => item.race === race);
            const chartData = filteredData.map(item => item.score);
            const chartLabels = filteredData.map(item => item.date);

            console.log('Chart data:', chartData); // Debugging line

            if (chart) {
                chart.destroy();
            }
            console.log('Chart configuration:', {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Score',
                        data: chartData,
                        fill: false, // Determines whether the area under the line is filled or not
                        borderColor: 'rgb(220, 53, 69)', // Color of the line
                        tension: 0.1, // Smoothness of the line
                        backgroundColor: 'rgba(220, 53, 69, 0.5)', // Color of the points
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category'
                        },
                        y: {
                            beginAtZero: true,
                            reverse: true
                        }
                    }
                }
            });
            chart = new Chart(scoreChartCanvas, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Score',
                        data: chartData,
                        fill: false, // Determines whether the area under the line is filled or not
                        borderColor: 'rgb(220, 53, 69)', // Color of the line
                        tension: 0.1, // Smoothness of the line
                        borderWidth: 2, // Width of the line
                        backgroundColor: 'rgba(220, 53, 69, 0.5)', // Color of the points
                        pointRadius: 5, // Radius of the points
                        pointHoverRadius: 10, // Radius of the points when hovered
                        pointHitRadius: 10, // Radius of the points for mouse events
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category'
                        },
                        y: {
                            beginAtZero: true,
                            reverse: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)', // Color of the horizontal grid lines
                            }
                        }
                    }
                }
            });
        }

        // Add event listeners to the race buttons
        document.querySelectorAll('.race-button').forEach(button => {
            button.addEventListener('click', () => {
                console.log('Button clicked:', button.dataset.race); // Debugging line
                updateChart(button.dataset.race);
            });
        });

        // Update the chart to show the scores for the latest race by default
        if (data.length > 0) {
            updateChart(data[0].race);
        }
    });
</script>
