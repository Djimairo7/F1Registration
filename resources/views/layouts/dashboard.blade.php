@extends('layouts.app')

@php
    $user = auth()->user();
    $profile = optional($user->profile);
@endphp

@section('content')
    <div class="container bg-secondary rounded">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-md-4 my-2">
                <div class="d-flex flex-wrap flex-md-column m-2">
                    <div class="col-8 col-md-12 mb-2">
                        <div class="card bg-black text-white p-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ $profile->profile_picture ? 'data:image/png;base64,' . $profile->profile_picture : 'https://vivaldi.com/wp-content/themes/vivaldicom-theme/img/new/icon.webp' }}"
                                        alt="Profile Picture" class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px;">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $profile->first_name ?? '' }}
                                        {{ $profile->last_name ?? '' }}</h5>
                                    <p class="card-text">{{ '@' . $user->username }}</p>
                                    <p class="card-text">Point Count: 54</p>
                                    <p>{{ $profile->bio ?? '' }}</p>
                                </div>
                                <hr>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <p class="m-0">{{ $currentRace['Circuit']['circuitName'] }}</p>
                                    </div>
                                    @php
                                        $lowestScore = \App\Models\Score::with('user')
                                            ->where('race_name', Str::slug(app('currentRace')['Circuit']['circuitName']))
                                            ->where('user_id', auth()->id())
                                            ->orderBy('score', 'asc')
                                            ->first();
                                    @endphp
                                    <div class="col-auto">
                                        @if (!empty($lowestScore))
                                            <p class="m-0">Tijd: {{ $lowestScore->score }}</p>
                                        @else
                                            <p class="m-0">Tijd: N/A</p>
                                        @endif
                                        {{-- <p class="m-0">Tijd: {{ $lowestScore->score }}</p> --}}
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('profile') }}" class="btn btn-danger">
                                    @if (Auth::user()->profile)
                                        Edit Profile
                                    @else
                                        Create Profile
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-12 mb-4">
                        <div class="card bg-black text-white p-2">
                            <div class="card-header">{{ __('Notifications') }}</div>
                            <div class="card-body overflow-auto">
                                @foreach ($notifications as $notification)
                                    <form action="{{ route('notification.destroy', $notification->id) }}" method="POST"
                                        class="btn bg-secondary d-flex justify-content-between align-items-center my-1">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="nav-link">
                                            <p class="my-1 mx-2">{{ $notification->message }}</p>
                                        </a>
                                        <button type="submit" class="btn text-danger">
                                            <i class="fas fa-trash ml-2"></i>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 order-3 order-md-3 my-2">
                <!-- Third Part -->
                <div class="d-flex flex-wrap flex-md-column m-2">
                    <div class="col-12 mb-2">
                        @yield('dashboard-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
