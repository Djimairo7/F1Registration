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
                                    @if ($users->isEmpty())
                                        @if (empty(request()->input('query')))
                                            <ul>
                                                @foreach ($allUsers as $user)
                                                    <li>{{ $user->username }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No users found.</p>
                                        @endif
                                    @else
                                        <ul>
                                            @foreach ($users as $user)
                                                <li>{{ $user->username }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
