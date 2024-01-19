@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="card mb-2 p-4 bg-black text-white">
        @if ($user)
            @isset($user->profile)
                @if ($user->profile && $user->profile->profile_picture)
                    <img src="{{ $user->profile->profile_picture ? 'data:image/png;base64,' . $user->profile->profile_picture : 'https://vivaldi.com/wp-content/themes/vivaldicom-theme/img/new/icon.webp' }}"
                        alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                @endif
                <p>{{ $user->profile->first_name }}</p>
                <p>{{ $user->profile->last_name }}</p>
                <p>{{ $user->profile->bio }}</p>
            @endisset
            <p>{{ '@' . $user->username }}</p>
        @endif
        <hr>
        @if ($user->scores)
            <h3>Scores:</h3>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Race Name</th>
                        <th scope="col">Score</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->scores as $score)
                        <tr>
                            <td>{{ ucwords(str_replace('-', ' ', $score->race_name)) }}</td>
                            <td>{{ $score->score }}</td>
                            <td>{{ $score->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
