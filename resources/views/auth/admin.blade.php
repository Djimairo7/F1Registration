@extends('layouts.app')



@section('content')

<div class="container bg-secondary">
    <div class="row">
        <div class="col-md-4">
            <div class="d-flex flex-md-column m-2">
                <div class="col-8 col-md-12 mb-2">
                    <div class="card bg-black text-white p-2">
                        <div class="card-header">{{ __('First Card') }}</div>
                        <div class="card-body">
                            <div class="text-center">

                                <img src="https://vivaldi.com/wp-content/themes/vivaldicom-theme/img/new/icon.webp" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            </div>

                            {{-- <h5 class="card-title">gay</h5> --}}
                            <p class="card-text">@JohnDoe60</p>
                            {{-- <p class="card-text">Username: {{ $username }}</p> --}}
                            <p class="card-text">Point Count: 54</p>
                            {{-- <p class="card-text">Point Count: {{ $pointCount }}</p> --}}
                            <a href="#" class="btn btn-danger">Edit Profile</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="d-flex flex-wrap flex-md-column m-2">
                <div class="col-8 col-md-12 mb-2">
                    <div class="card bg-black text-white p-2">
                        <div class="card-header">Users</div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="input-group mb-3">
                                    @foreach ($allusers as $user)

                                    <div class="form-group mb-3">

                                        <form action="/admin">
                                            <input value="{{ $user->username }}" class="">

                                            </input>
                                            @endforeach
                                        </form>
                                    </div>
                                    <div>
                                        <button type="submit" action="POST>
                                            submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection