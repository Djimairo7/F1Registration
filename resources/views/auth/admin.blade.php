@extends('layouts.app')



@section('content')
<p class="text-white">why it neva work</p>
@foreach ($allusers as $user)
<p class="text-white">
    {{ $user->username }}
</p>

@endforeach
@endsection