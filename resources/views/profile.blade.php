@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="card mb-2 bg-black text-white">

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                @if (auth()->user()->profile && auth()->user()->profile->profile_picture)
                    <img src="data:image/png;base64,{{ auth()->user()->profile->profile_picture }}" alt=""
                        class="d-flex mx-auto mt-3" style="width: 350px; height: 350px;">
                @endif

                <div class="d-flex align-items-center d-flex justify-content-center">
                    <input type="file" name="profile_picture" id="profile_picture" class="d-none"
                        onchange="previewImageUpdate()" accept="image/*">
                    <label id="profileImageLabel" for="profile_picture" class="btn btn-danger mt-3 mx-1 w-25 ">
                        Select Image
                    </label>
                    <button type="submit" name="remove_picture" value="remove"
                        class="btn btn-secondary text-danger mx-1 mt-3">
                        <i class="fas fa-trash ml-2"></i>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="{{ auth()->user()->profile->first_name }}">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="{{ auth()->user()->profile->last_name }}">
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" id="bio" name="bio">{{ auth()->user()->profile->bio }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
