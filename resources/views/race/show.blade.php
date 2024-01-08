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
    <div class="text-white">
        <h1>{{ $race['raceName'] }}</h1>
        <p class="my-1 mx-2">{{ $race['Circuit']['Location']['locality'] }}</p>
        <p class="my-1 mx-2">{{ $race['Circuit']['circuitName'] }}</p>
        <p class="my-1 mx-2">{{ $race['Circuit']['Location']['country'] }}</p>
        <p class="my-1 mx-2">{{ $race['date'] }}</p>
    </div>
@endsection
