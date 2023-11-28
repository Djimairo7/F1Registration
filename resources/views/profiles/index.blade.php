@extends('layouts.app')

@section('content')
    <!-- display text f1registration and index -->
<div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>F1 Registration App</h1>
        <p>INDEX</p>
    </div>
    <div class="offset-2 col-8">
    <table class="table table-striped">
    <!-- start a table displaying first name last name and actions     -->
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- create an if statement that says if session is succesfully made display succes alert -->
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <!-- foreach through $profiles to display profile -->
        @foreach ($profiles as $profile)
           <!-- table with links to profiles edit button and delete button -->
            <tr>
                <td>
                    <a href="{{ route('profiles.show', $profile->id) }}">Link for profile {{ $profile->user_id }}</a>
                </td>
                <td>{{ $profile->lastname }}</td>
                <td>
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection

