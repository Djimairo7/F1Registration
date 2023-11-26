@extends('layouts.app')

@section('content')
    <div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>F1 Registration App</h1>
        <p>CREATE</p>
    </div>
    <div class="col-8 offset-2">
    <form action="/profiles-store" method="post">
        @csrf
    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
<label> First Name:</label>
<input type="text" name="firstname" />
<label> Last Name:</label>
<input type="text" name="lastname" />
<input type="submit" value="Add">

</form>
@endsection


