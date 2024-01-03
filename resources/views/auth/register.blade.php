@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-dark text-white rounded overflow-hidden">
                <div class="p-3">
                    <h1 class="text-danger text-center">Registreer</h1>

                    <body>
                        <div class="card-body">
                            @if(Session::has('success'))
                            <div class="alert alert-succes" role="alert">
                                {{ Session::get('success') }}
                            </div>
                            @endif



                            <form action="/register" method="post" enctype="multipart/form-data" class="p-3">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name class=form-label">
                                        Gebruikersnaam
                                    </label>
                                    <input value="{{ old('name') }}" type="name" name="name" id="name" class="form-control bg-secondary text-white" placeholder="Vul hier je gebruikersnaam in" required>
                                    @error('name')
                                    <p class="text-danger">{{ $message}}</p>

                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label text-white">
                                        Email
                                    </label>
                                    <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control bg-secondary text-white" placeholder="Vul hier je email in" required>
                                    @error('email')
                                    <p class="text-danger">{{ $message}}</p>

                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class=" form-label">
                                        Wachtwoord
                                    </label>
                                    <input type="password" id="password" name="password" class="form-control bg-secondary text-white" placeholder="Vul hier je wachtwoord in" required>
                                    @error('password')
                                    <p class="text-danger">{{ $message}}</p>

                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger mt-3 w-25 align-items-center d-flex justify-content-center mx-auto">
                                    Registreer
                                </button>
                                <div class="container p-3 d-flex justify-content-center align-items-end">
                                    <a href="/login" class="text-white font-weight-bold text-decoration-none">Heb je al
                                        een
                                        account? log hier in
                                    </a>
                                </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session()->has('success'))
<div class="fixed bg-danger-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
    <p> {{ session()->get('success') }}</p>
</div>
@endif
</body>



@endsection