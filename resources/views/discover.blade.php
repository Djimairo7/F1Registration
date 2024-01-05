@extends('layouts.app')

@section('content')
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
                                {{-- <h5 class="card-title">{{ $fullName }}</h5> --}}
                                <h5 class="card-title">{{ __('Get Name') }}</h5>
                                {{-- <p class="card-text">@JohnDoe60</p> --}}
                                <p class="card-text">{{ '@' . $username }}</p>
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
                                <h4>Notifications</h4>
                                <ul>
                                    @foreach ($notifications as $notification)
                                        <li>{{ $notification->message }}</li>
                                    @endforeach
                                </ul>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
