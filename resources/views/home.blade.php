@extends('layouts.app')

@section('content')
    <div class="container bg-gray">
        <div class="row">
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div> --}}

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
                                <h5 class="card-title">{{ $fullName }}</h5>
                                <p class="card-text">@JohnDoe60</p>
                                <!-- <p class="card-text">Username: {{ $username }}</p> -->
                                <p class="card-text">Point Count: 54</p>
                                <!-- <p class="card-text">Point Count: {{ $pointCount }}</p> -->
                                <a href="#" class="btn btn-danger">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-12 mb-4">
                        <div class="card bg-black text-white p-2">
                            <div class="card-header">{{ __('Second Card') }}</div>
                            <div class="card-body">
                                <!-- Content for the second card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card my-2 bg-black text-white">
                    <div class="card-header bg-red">
                        <h5 class="mb-0">
                            <button class="btn w-100 text-left text-white" onclick="toggleCollapse('currentRaceTable')"
                                aria-expanded="true" aria-controls="currentRaceTable">
                                Huidige race
                            </button>
                        </h5>
                    </div>

                    <div id="currentRaceTable" class="collapse show">
                        <div class="card-body d-flex flex-column">
                            @if (!empty($races))
                                @php
                                    $currentDate = \Carbon\Carbon::parse('2023-09-22T02:30:00+00:00'); //set current date
                                    // $currentRace = now(); // set back to the current date
                                    $currentRace = null; //set the current race to null for fallback
                                @endphp

                                @foreach ($races as $key => $race)
                                    @php
                                        // go through each entry of the json list
                                        $raceStartDate = \Carbon\Carbon::parse($race['date_start']); //set the start date to the start date of a race
                                        $raceEndDate = isset($races[$key + 1]) ? \Carbon\Carbon::parse($races[$key + 1]['date_start']) : null; //set the end date to the start date plus 1
                                    @endphp

                                    @if ($currentDate->between($raceStartDate, $raceEndDate))
                                        @php
                                            //check the race start and the race end date to see if the current date is in between them
                                            $currentRace = $race;
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                @if ($currentRace)
                                    <a href="#" class="btn bg-gray my-1 mx-2 d-flex flex-row">
                                        <p class="my-1 mx-2">{{ $currentRace['location'] }}</p>
                                        <p class="my-1 mx-2">{{ $currentRace['meeting_name'] }}</p>
                                        <p class="my-1 mx-2">{{ $currentRace['country_name'] }}</p>
                                        <p class="my-1 mx-2">{{ $currentRace['date_start'] }}</p>
                                    </a>
                                @else
                                    <p>No race is scheduled currently.</p>
                                @endif
                            @else
                                <p>No races found.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card my-2 bg-black text-white">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn w-100 text-left text-white" onclick="toggleCollapse('previousRaceTable')"
                                aria-expanded="false" aria-controls="previousRaceTable">
                                Eerdere races
                            </button>
                        </h5>
                    </div>

                    <div id="currentRaceTable" class="collapse show">
                        <div class="card-body d-flex flex-column">
                            @if (!empty($races))
                                @foreach ($races as $race)
                                    <a href="#" class="btn bg-gray my-1 mx-2 d-flex flex-row">
                                        <p class="my-1 mx-2">{{ $race['location'] }}</p>
                                        <p class="my-1 mx-2">{{ $race['meeting_name'] }}</p>
                                        <p class="my-1 mx-2">{{ $race['country_name'] }}</p>
                                        <p class="my-1 mx-2">{{ $race['date_start'] }}</p>
                                    </a>
                                @endforeach
                            @else
                                <p>No races found.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card my-2 bg-black text-white">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn w-100 text-sm-left text-white" onclick="toggleCollapse('futureRaceTable')"
                                aria-expanded="false" aria-controls="futureRaceTable">
                                Toekomstige races
                            </button>
                        </h5>
                    </div>

                    <div id="currentRaceTable" class="collapse show">
                        <div class="card-body d-flex flex-column">
                            @if (!empty($races))
                                @foreach ($races as $race)
                                    <a href="#" class="btn bg-gray my-1 mx-2 d-flex flex-row">
                                        <p class="my-1 mx-2">{{ $race['location'] }}</p>
                                        <p class="my-1 mx-2">{{ $race['meeting_name'] }}</p>
                                        <p class="my-1 mx-2">{{ $race['country_name'] }}</p>
                                        <p class="my-1 mx-2">{{ $race['date_start'] }}</p>
                                    </a>
                                @endforeach
                            @else
                                <p>No races found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .collapse {
            display: none;
        }

        .collapse.show {
            display: block;
        }

        .bg-light-gray {
            background-color: rgb(238, 238, 238)
        }

        .bg-gray {
            background-color: rgb(117, 117, 117);
        }

        .bg-dark-gray {
            background-color: rgb(38, 38, 38);
        }

        .bg-red {
            background-color: rgb(255, 0, 0);
            color: black;
        }
    </style>

    <script>
        function toggleCollapse(tableId) {
            var raceTable = document.getElementById(tableId);
            var cardHeader = raceTable.previousElementSibling;

            // Close all other tables
            var allTables = document.getElementsByClassName('collapse');
            for (var i = 0; i < allTables.length; i++) {
                if (allTables[i].id !== tableId) {
                    allTables[i].style.display = 'none';
                    allTables[i].previousElementSibling.classList.remove('bg-red');
                }
            }

            // Toggle the selected table
            raceTable.style.display = (raceTable.style.display === 'none' || raceTable.style.display === '') ? 'block' :
                'none';
            cardHeader.classList.toggle('bg-red');
        }
    </script>

@endsection
