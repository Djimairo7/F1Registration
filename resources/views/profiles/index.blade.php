@extends('layouts.app')

@section('content')
    <div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>F1 Registration App</h1>
        <p>INDEX</p>
    </div>
    <div class="offset-2 col-8">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $profile)
            <tr>
                <td>
                <a href="{{ route('profiles.show', $profile->id) }}">Link for profile {{ $profile->user_id }}</a>
  
                <a href="{{ route('profiles', $profile->user_id) }}" ></a>
                </td>
                <td>{{ $profile->lastname }}</td>
                <td>
                    <a href="/profiles/{{ $profile->id }}/edit" class="btn btn-primary">Edit</a>
                    <form action="/profiles/{{ $profile->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form><form action="{{ route ('profiles.destroy, $profile->id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"> </button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection

