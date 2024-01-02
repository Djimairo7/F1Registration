@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-dark text-white rounded overflow-hidden">
                <div class="p-3">
                    <h1 class="text-danger text-center">Registreer</h1>

                    <body>

                        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name class=form-label">
                                    Gebruikersnaam
                                </label>
                                <input type="text" name="name" class="form-control bg-secondary text-white" id="name" placeholder="Vul hier je gebruikersnaam in" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label text-white">
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control bg-secondary text-white" placeholder="Vul hier je email in" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class=" form-label">
                                    Wachtwoord
                                </label>
                                <input type="password" id="password" name="password" class="form-control bg-secondary text-white" placeholder="Vul hier je wachtwoord in" required>
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
</body>



@endsection