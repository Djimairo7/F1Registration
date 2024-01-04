@extends('layouts.app')

@section('content')

    @php
        $currentDate = \Carbon\Carbon::parse('2024-09-22'); //set custom date
        // $currentDate = now(); // set back to the current date

        if (isset($getRaces['MRData']['RaceTable']['Races'])) {
            $races = $getRaces['MRData']['RaceTable']['Races']; //go through the list of data to get to the first entry
        }
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
                <div class="d-flex flex-wrap flex-md-column m-2 sticky-top">
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
                    <div class="card-header bg-danger">
                        <h5 class="mb-0">
                            <button
                                class="btn w-100 text-sm-left text-white d-flex align-items-center justify-content-between"
                                onclick="toggleCollapse('currentRaceTable', 'currentRaceTableIcon')" aria-expanded="true"
                                aria-controls="currentRaceTable">
                                <p class="mb-0 align-self-center">Huidige race -{{ $currentRace['Circuit']['circuitName'] }}
                                </p>
                                <i id="currentRaceTableIcon" class="fas fa-chevron-up ml-2"></i>
                            </button>
                        </h5>
                    </div>



                    <div id="currentRaceTable" class="collapse show">
                        <div class="card-body d-flex flex-column">
                            @if (!empty($races))
                                @if ($currentRace)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <img src="{{ $raceImages[Str::slug($currentRace['Circuit']['Location']['country'])] }}"
                                                    alt="{{ $currentRace['Circuit']['Location']['country'] }} Preview"
                                                    class="img-fluid">
                                                <p class="my-0">{{ $currentRace['Circuit']['circuitName'] }},
                                                    {{ $currentRace['Circuit']['Location']['country'] }}</p>
                                                <p class="my-0">{{ $currentRace['date'] }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                            <form class="text-center" method="POST" action="#">
                                                @csrf
                                                <h2 class="mb-4">Tijd Toevoegen</h2>
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-lg bg-secondary text-white border-0 text-center"
                                                        placeholder="Gereden Tijd" name="Time">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="UplRaceImg"
                                                            name="UplRaceImg" hidden>
                                                        <label
                                                            class="custom-file-label form-control form-control-lg bg-secondary border-0 text-center"
                                                            for="UplRaceImg">Upload Image</label>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-lg btn-block mt-3">Opslaan</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <p>No race is scheduled currently.</p>
                                @endif
                            @else
                                <p>No races found.</p>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- <div class="card my-2 bg-black text-white">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn w-100 text-sm-left text-white" onclick="toggleCollapse('futureRaceTable')"
                                aria-expanded="false" aria-controls="futureRaceTable">
                                Toekomstige races
                            </button>
                        </h5>
                    </div>

                    <div id="futureRaceTable" class="collapse">
                        <div class="card-body d-flex flex-column">
                            @foreach ($races as $race)
                                <a href="#" class="btn bg-secondary my-1 d-flex flex-row">
                                    <p class="my-1 mx-2">{{ $race->name }}</p>
                                    <p class="my-1 mx-2">{{ $race->location }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div> --}}

                <div class="card my-2 bg-black text-white">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button
                                class="btn w-100 text-sm-left text-white d-flex align-items-center justify-content-between"
                                onclick="toggleCollapse('previousRaceTable', 'previousRaceTableIcon')" aria-expanded="false"
                                aria-controls="futureRaceTable">
                                <p class="mb-0 align-self-center">Eerdere races</p>
                                <i id="previousRaceTableIcon" class="fas fa-chevron-down ml-2"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="previousRaceTable" class="collapse">
                        <div class="card-body d-flex flex-column">
                            @if (!empty($races))
                                @foreach ($races as $key => $race)
                                    @php
                                        $raceStartDate = \Carbon\Carbon::parse($race['date']);
                                    @endphp

                                    @if ($raceStartDate->lt($currentDate))
                                        <a href="#" class="btn bg-secondary my-1 mx-2 d-flex justify-content-between">
                                            <p class="my-1 mx-2">{{ $race['Circuit']['Location']['locality'] }}</p>
                                            <p class="my-1 mx-2">{{ $race['Circuit']['circuitName'] }}</p>
                                            <p class="my-1 mx-2">{{ $race['Circuit']['Location']['country'] }}</p>
                                            <p class="my-1 mx-2">{{ $race['date'] }}</p>
                                            <span class="d-flex align-items-center">&#x25B6;</span>
                                        </a>
                                    @endif
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
                            <button
                                class="btn w-100 text-sm-left text-white d-flex align-items-center justify-content-between"
                                onclick="toggleCollapse('futureRaceTable', 'futureRaceTableIcon')" aria-expanded="false"
                                aria-controls="futureRaceTable">
                                <p class="mb-0 align-self-center">Toekomstige races</p>
                                <i id="futureRaceTableIcon" class="fas fa-chevron-down ml-2"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="futureRaceTable" class="collapse">
                        <div class="card-body d-flex flex-column">
                            @if (!empty($races))
                                @foreach ($races as $race)
                                    @php
                                        $raceStartDate = \Carbon\Carbon::parse($race['date']);
                                    @endphp

                                    @if ($raceStartDate->gt($currentDate))
                                        <a href="#"
                                            class="btn bg-secondary my-1 mx-2 d-flex justify-content-between">
                                            <p class="my-1 mx-2">{{ $race['Circuit']['Location']['locality'] }}</p>
                                            <p class="my-1 mx-2">{{ $race['Circuit']['circuitName'] }}</p>
                                            <p class="my-1 mx-2">{{ $race['Circuit']['Location']['country'] }}</p>
                                            <p class="my-1 mx-2">{{ $race['date'] }}</p>
                                            <span class="d-flex align-items-center">&#x25B6;</span>
                                        </a>
                                    @endif
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

    <script>
        function toggleCollapse(tableId, iconId) {
            var raceTable = document.getElementById(tableId);
            var cardHeader = raceTable.previousElementSibling;
            var icon = document.getElementById(iconId);

            // Add the classes
            cardHeader.classList.add('bg-danger');
            icon.classList.add('fa-chevron-up');

            // Open the selected table
            if (cardHeader.classList.contains('bg-danger')) {
                raceTable.style.display = 'block';
            }

            // Close all other tables
            var allTables = document.getElementsByClassName('collapse');
            var allIcons = document.querySelectorAll('i.fas');
            for (var i = 0; i < allTables.length; i++) {
                if (allTables[i].id !== tableId) {
                    allTables[i].style.display = 'none';
                    allTables[i].previousElementSibling.classList.remove('bg-danger');
                }
                if (allIcons[i].id !== iconId) {
                    allIcons[i].classList.add('fa-chevron-down');
                    allIcons[i].classList.remove('fa-chevron-up');
                }
            }
        }
    </script>

@endsection
