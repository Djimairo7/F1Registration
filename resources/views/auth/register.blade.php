@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-black text-white rounded overflow-hidden">
                <div class="p-3">
                    <style>
                        body {
                            overflow: hidden;
                        }
                    </style>

                    <body>


                        <form action="" method="post" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username class=text-white">
                                    Gebruikersnaam
                                </label>
                                <input type="text" name="username" class="form-control bg-secondary text-white"
                                    placeholder="Vul hier je gebruikersnaam in">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="text-white">
                                    Email
                                </label>
                                <input type="text" name="email" class="form-control bg-secondary text-white"
                                    placeholder="Vul hier je email in">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="text-white">
                                    Wachtwoord
                                </label>
                                <input type="text" id="password" name="password"
                                    class="form-control bg-secondary text-white"
                                    placeholder="Vul hier je wachtwoord in">
                                <div class="container p-3 d-flex justify-content-center align-items-end">
                                    <a href="/login" class="text-danger font-weight-bold text-decoration-none">Heb je al
                                        een
                                        account? log hier in
                                    </a>

                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-danger  w-25 align-items-center d-flex justify-content-center mx-auto">
                                Registreer
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>



@endsection