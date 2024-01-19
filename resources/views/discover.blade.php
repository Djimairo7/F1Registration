@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="card bg-black text-white p-2">
        <div class="card-header">{{ __('Search') }}</div>
        <div class="card-body">
            <form action="{{ route('discover') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="search" class="form-control bg-secondary border-0 text-white" placeholder="Search..."
                        name="query" value="{{ request()->input('query') }}">
                    <button class="btn btn-danger btn-primary" type="submit">Search</button>
                </div>
            </form>
            <div class="search-results">
                <h3>Users</h3>
                @if (!empty($filteredUsers))
                    <div class="card-container overflow-x-scroll">
                        <div class="d-inline-flex">
                            @foreach ($filteredUsers as $user)
                                <div class="card m-2 d-inline-grid flex-shrink-0 bg-secondary">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-nowrap text-white">{{ $user->username }}</h5>
                                        <a href="{{ url('/profile/' . $user->id) }}" class="btn btn-danger btn-primary mt-auto">
                                            View Details
                                        </a>
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
                                <div class="card m-2 d-inline-grid flex-shrink-0 bg-secondary">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-nowrap text-white">{{ $race['raceName'] }}</h5>
                                        <p class="card-text text-nowrap text-white">Locality:
                                            {{ $race['Circuit']['Location']['locality'] }}</p>
                                        <p class="card-text text-nowrap text-white">Circuit Name:
                                            {{ $race['Circuit']['circuitName'] }}</p>
                                        <p class="card-text text-nowrap text-white">Country:
                                            {{ $race['Circuit']['Location']['country'] }}</p>
                                        <p class="card-text text-nowrap text-white">Date: {{ $race['date'] }}</p>
                                        <a href="{{ route('race.show', ['raceName' => Str::slug($race['Circuit']['circuitName'])]) }}"
                                            class="btn btn-primary mt-auto btn-danger">
                                            View Details
                                        </a>
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
                                <div class="card m-2 d-inline-grid flex-shrink-0 bg-secondary">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-nowrap text-white">{{ $driver['givenName'] }}
                                            {{ $driver['familyName'] }}
                                        </h5>
                                        <p class="card-text text-nowrap text-white">Nationality:
                                            {{ $driver['nationality'] }}</p>
                                        </p>
                                        <p class="card-text text-nowrap text-white">Number:
                                            {{ $driver['permanentNumber'] }}</p>
                                        <a href="#" class="btn btn-danger btn-primary mt-auto">
                                            View Details
                                        </a>
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
@endsection
