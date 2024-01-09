@extends('layouts.app')



@section('content')
<p class="text-white">why it neva work</p>
@php
dd ($user)
@endphp
<p>{{ $user->username }}</p>
@endsection