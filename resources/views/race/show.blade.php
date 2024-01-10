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
    <div class="card bg-black text-white p-2">
        <div id="currentRaceTable" class="collapse show">
            <div class="card-body d-flex flex-column">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            {{-- @php
                                dd($race);
                            @endphp --}}
                            <img src="{{ $raceImages[Str::slug($race['Circuit']['Location']['country'])] }}"
                                alt="{{ $race['Circuit']['Location']['country'] }} Preview" class="img-fluid">
                            <p class="my-0">{{ $race['Circuit']['circuitName'] }},
                                {{ $race['Circuit']['Location']['country'] }}</p>
                            <p class="my-0">{{ $race['date'] }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <form class="text-center" method="POST"
                            action="{{ route('race.submit', ['raceName' => Str::slug($race['Circuit']['circuitName'])]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <h2 class="mb-4">Tijd Toevoegen</h2>
                            <div class="form-group">
                                <input type="text" id="timeInput"
                                    class="form-control form-control-lg bg-secondary text-white border-0 text-center"
                                    placeholder="Gereden Tijd" name="Time" maxlength="6">
                                @error('Time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="UplRaceImg" name="UplRaceImg"
                                        hidden>
                                    <label
                                        class="btn custom-file-label form-control form-control-lg bg-secondary border-0 text-center"
                                        for="UplRaceImg">
                                        Upload Image
                                    </label>
                                    @error('UplRaceImg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg btn-block mt-3">Opslaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Score</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $index => $score)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $score->user->username }}</td>
                    <td>{{ $score->score }}</td>
                    <td>
                        <img src="data:image/png;base64,{{ $score->image }}" alt="User Image" width="50"
                            height="50">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
