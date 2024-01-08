@extends('layout.app')

@section('content')
    <h1>{{ $race->name }}</h1>
    <p>{{ $race->description }}</p>
@endsection
