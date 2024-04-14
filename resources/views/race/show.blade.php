@extends('layouts.dashboard')

@if (!empty($races))
    @foreach ($races as $key => $race)
        @php
            // go through each entry of the json list
            $raceStartDate = \Carbon\Carbon::parse($race['date']); //set the start date to the start date of a race
            $raceEndDate = isset($races[$key + 1]) ? \Carbon\Carbon::parse($races[$key + 1]['date']) : null; //set the end date to the start date plus 1
        @endphp

        @if ($currentDate->between($raceStartDate, $raceEndDate))
            @php
                //check the race start and the race end date to see if the current date is in between them
                $currentRace = $race; //set the current race to the race that currently going on
                break;
            @endphp
        @endif
    @endforeach
@endif

@section('dashboard-content')
    <div class="card bg-black text-white p-2 mb-2">
        <div class="card-body d-flex flex-column">
            <div class="row">
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="row">
                        <p class="my-0"><b>Race name:</b> {{ $race['raceName'] }}</p>
                        <p class="my-0"><b>Circuit name:</b> {{ $race['Circuit']['circuitName'] }}</p>
                        <p class="my-0"><b>Country:</b> {{ $race['Circuit']['Location']['country'] }}</p>
                        <p class="my-0"><b>Locality:</b> {{ $race['Circuit']['Location']['locality'] }}</p>
                        <p class="my-0"><b>Date:</b> {{ $race['date'] }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ $raceImages[Str::slug($race['Circuit']['Location']['country'])] }}"
                        alt="{{ $race['Circuit']['Location']['country'] }} Preview" class="img-fluid">
                </div>
            </div>
            @isset($scores)
                @if (count($scores) > 2)
                    {{-- if there are more than 2 scores, then set the alignment to 2nd, 1st, 3rd --}}
                    @php
                        $topThreeScores = $scores->splice(0, 3);
                        $nextSevenScores = $scores->splice(0, 7);
                        $orderedScores = [1 => $topThreeScores[1], 0 => $topThreeScores[0], 2 => $topThreeScores[2]];
                    @endphp
                @else
                    {{-- else set it to be 1, 2, 3 --}}
                    @php
                        $topThreeScores = $scores->splice(0, 3);
                        $nextSevenScores = $scores->splice(0, 7);
                        $orderedScores = $topThreeScores;
                    @endphp
                @endif
            @endisset
            <div class="row">
                @foreach ($orderedScores as $index => $score)
                    <div class="col d-flex flex-column justify-content-end px-0">
                        <div
                            class="card bg-dark text-white rounded-bottom-0 pb-{{ 2 * (2 - $index) }} mt-{{ 2 * (2 - $index) }}">
                            <div class="card-body mt-{{ 2 * (2 - $index) }}">
                                <h1 class="text-center">{{ $index + 1 }}</h1>
                                <div class="row align-items-center">
                                    @isset($score->user->profile->profile_picture)
                                        <img class="d-flex img-responsive rounded-circle mx-auto w-75"
                                            src="data:image/png;base64,{{ $score->user->profile->profile_picture }}"
                                            alt="User Image">
                                    @endisset
                                    <div class="col-8">
                                        <h5 class="card-title">
                                            {{ $score->user->profile->first_name ?? 'User not found' }}
                                            {{ $score->user->profile->last_name ?? '' }}</h5>
                                        <p class="card-text">Score: {{ $score->score }}</p>
                                    </div>
                                    <div class="col-4 text-right">
                                        @isset($score->image)
                                            <img class="" src="data:image/png;base64,{{ $score->image }}"
                                                alt="User Image" width="50" height="50">
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (count($nextSevenScores) > 0)
                    <table class="table table-dark mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Score</th>
                                <th scope="col">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nextSevenScores as $index => $score)
                                <tr>
                                    <th scope="row">{{ $index + 4 }}</th>
                                    <td>{{ $score->user->profile->first_name ?? 'User not found' }}
                                        {{ $score->user->profile->last_name ?? '' }}</td>
                                    <td>{{ $score->score }}</td>
                                    <td>
                                        @isset($score->image)
                                            <img class="" src="data:image/png;base64,{{ $score->image }}"
                                                alt="User Image" width="50" height="50">
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @if (count($topThreeScores) < 1)
                    <h2 class="text-center my-5">No entries yet</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
