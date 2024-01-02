@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-dark text-white rounded overflow-hidden">
                <div class="p-3">
                    <h1 class="text-danger text-center">Login</h1>
                    <form action="" method="post" enctype="multipart/form-data" class="p-3">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="text-white">
                                Email
                            </label>
                            <input type="text" name="email" class="form-control bg-secondary text-white" placeholder="Vul hier je email in">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="text-white">
                                Wachtwoord
                            </label>
                            <input type="text" id="password" name="password" class="form-control bg-secondary text-white" placeholder="Vul je wachtwoord in">
                            <div class="container p-3 d-flex justify-content-center align-items-end">
                                <a href="/register" class="text-white font-weight-bold text-decoration-none">Nog geen
                                    account? Registreer hier</a>
                            </div>
                            <div class="container p-3 d-flex justify-content-center">
                                <a href="/placeholder" class="text-white font-weight-bold text-decoration-none">
                                    Wachtwoord Vergeten?

                                </a>
                            </div>

                        </div>

                </div>
                <div class="container p-3 d-flex justify-content-center mb-4 align-items-center">
                    <button type="submit" class="btn btn-danger w-25">
                        Login
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@endsection