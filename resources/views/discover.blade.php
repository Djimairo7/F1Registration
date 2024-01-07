@extends('layouts.app')

@section('content')

    @php
        $currentDate = \Carbon\Carbon::parse('2024-09-22'); //set custom date
        // $currentDate = now(); // set back to the current date
    @endphp

    @if (!empty($races))
        @php
            $currentRace = null; //set the current race to null for fallback
        @endphp

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

    <div class="container bg-secondary">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex flex-wrap flex-md-column m-2">
                    <div class="col-8 col-md-12 mb-2">
                        <div class="card bg-black text-white p-2">
                            <div class="card-header">{{ __('First Card') }}</div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="https://vivaldi.com/wp-content/themes/vivaldicom-theme/img/new/icon.webp"
                                        alt="Profile Picture" class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px;">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $fullName }}</h5>
                                    <p class="card-text">@JohnDoe60</p>
                                    <!-- <p class="card-text">Username: {{ $username }}</p> -->
                                    <p class="card-text">Point Count: 54</p>
                                </div>
                                <hr>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <p class="m-0">{{ $currentRace['Circuit']['circuitName'] }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="m-0">Tijd: 1.23.456</p>
                                    </div>
                                </div>
                                <hr>
                                <a href="#" class="btn btn-danger">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-12 mb-4">
                        <div class="card bg-black text-white p-2">
                            <div class="card-header">{{ __('Notifications') }}</div>
                            <div class="card-body overflow-auto">
                                @foreach ($notifications as $notification)
                                    <div class="btn bg-secondary d-flex justify-content-between align-items-center">
                                        <a href="#" class="nav-link">
                                            <p class="my-1 mx-2">{{ $notification->message }}</p>
                                        </a>
                                        <a href="#" class="text-danger">
                                            <i class="fas fa-trash ml-2"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex flex-wrap flex-md-column m-2">
                    <div class="col-8 col-md-12 mb-2">
                        <div class="card bg-black text-white p-2">
                            <div class="card-header">{{ __('Search') }}</div>
                            <div class="card-body">
                                <form action="{{ route('discover') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="search" class="form-control" placeholder="Search..." name="query"
                                            value="{{ request()->input('query') }}">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </form>
                                <div class="search-results">
                                    <h3>Users</h3>
                                    @if (!empty($filteredUsers))
                                        <div class="card-container overflow-x-scroll">
                                            <div class="d-inline-flex">
                                                @foreach ($filteredUsers as $user)
                                                    <div class="card m-2 d-inline-grid flex-shrink-0">
                                                        <div class="card-body d-flex flex-column">
                                                            <h5 class="card-title text-nowrap">{{ $user->username }}</h5>
                                                            <a href="#" class="btn btn-primary mt-auto">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p>No users found.</p>
                                    @endif

                                    <h3>Races</h3>
                                    <div class="card-container overflow-x-scroll">
                                        <div class="d-inline-flex">
                                            @if (!empty($filteredRaces))
                                                @foreach ($filteredRaces as $race)
                                                    <div class="card m-2 d-inline-grid flex-shrink-0">
                                                        <div class="card-body d-flex flex-column">
                                                            <h5 class="card-title text-nowrap">{{ $race['raceName'] }}</h5>
                                                            <p class="card-text text-nowrap">Locality:
                                                                {{ $race['Circuit']['Location']['locality'] }}</p>
                                                            <p class="card-text text-nowrap">Circuit Name:
                                                                {{ $race['Circuit']['circuitName'] }}</p>
                                                            <p class="card-text text-nowrap">Country:
                                                                {{ $race['Circuit']['Location']['country'] }}</p>
                                                            <p class="card-text text-nowrap">Date: {{ $race['date'] }}</p>
                                                            <a href="#" class="btn btn-primary mt-auto">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No races found.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <h3>Drivers</h3>
                                    <div class="card-container overflow-x-scroll">
                                        <div class="d-inline-flex">
                                            @if (!empty($filteredDrivers))
                                                @foreach ($filteredDrivers as $driver)
                                                    <div class="card m-2 d-inline-grid flex-shrink-0">
                                                        <div class="card-body d-flex flex-column">
                                                            <h5 class="card-title text-nowrap">{{ $driver['givenName'] }}
                                                                {{ $driver['familyName'] }}
                                                            </h5>
                                                            <p class="card-text text-nowrap">Nationality:
                                                                {{ $driver['nationality'] }}</p>
                                                            </p>
                                                            <p class="card-text text-nowrap">Number:
                                                                {{ $driver['permanentNumber'] }}</p>
                                                            <a href="#" class="btn btn-primary mt-auto">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No drivers found.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
