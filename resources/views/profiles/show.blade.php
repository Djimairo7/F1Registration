@extends('layouts.app')

@section('content')
    <div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>F1 Registration App</h1>
        <p>SHOW</p>
    </div>
    <div class="col8 offset-2">
    <p>Firstname: {{ $profile->firstname }}</p>
    <p>Lastname: {{ $profile->lastname }}</p>
    <a href="{{ route('profiles.index') }}" class="btn btn-primary">Back</a>
</div>




    @endsection

