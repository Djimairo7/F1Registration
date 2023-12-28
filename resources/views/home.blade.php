@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link" onclick="toggleCollapse('currentRaceTable')" aria-expanded="true" aria-controls="currentRaceTable">
                    Huidige race
                </button>
            </h5>
        </div>

        <div id="currentRaceTable" class="collapse show">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Locatie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($races as $race)
                        <tr>
                            <td>{{ $race->name }}</td>
                            <td>{{ $race->location }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link" onclick="toggleCollapse('previousRaceTable')" aria-expanded="true" aria-controls="previousRaceTable">
                    Eerdere races
                </button>
            </h5>
        </div>

        <div id="previousRaceTable" class="collapse">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Locatie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($races as $race)
                        <tr>
                            <td>{{ $race->name }}</td>
                            <td>{{ $race->location }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link" onclick="toggleCollapse('futureRaceTable')" aria-expanded="true" aria-controls="futureRaceTable">
                    Toekomstige races
                </button>
            </h5>
        </div>

        <div id="futureRaceTable" class="collapse">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Locatie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($races as $race)
                        <tr>
                            <td>{{ $race->name }}</td>
                            <td>{{ $race->location }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
</style>

<script>
    function toggleCollapse(tableId) {
        var raceTable = document.getElementById(tableId);

        // Close all other tables
        var allTables = document.getElementsByClassName('collapse');
        for (var i = 0; i < allTables.length; i++) {
            if (allTables[i].id !== tableId) {
                allTables[i].style.display = 'none';
            }
        }

        // Toggle the selected table
        raceTable.style.display = (raceTable.style.display === 'none' || raceTable.style.display === '') ? 'block' : 'none';
    }
</script>

@endsection