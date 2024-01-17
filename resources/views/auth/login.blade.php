@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="container p-3">
            <div class="row justify-content-center">
                <div class="col-md-6 bg-dark text-white rounded overflow-hidden">
                    <div class="p-3">
                        <h1 class="text-danger text-center">Login</h1>
                        @if ($errors->any())
                            <p class="text-danger text-center">{{ $errors->first() }}</p>
                        @endif
                        <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="text-white">
                                    Email
                                </label>
                                <input value="{{ old('email') }}" type="email" name="email"
                                    class="form-control bg-secondary text-white" placeholder="Vul hier je email in"
                                    required>

                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="text-white">
                                    Wachtwoord
                                </label>
                                <input type="password" id="password" name="password"
                                    class="form-control bg-secondary text-white" placeholder="Vul je wachtwoord in"
                                    required>
                            </div>
                            <div>
                                <button type="submit"
                                    class="btn btn-danger mt-3 w-25 align-items-center d-flex justify-content-center mx-auto">
                                    Login
                                </button>
                            </div>
                            <div class="container p-3 d-flex justify-content-center align-items-end">
                                <a href="/register" class="text-white font-weight-bold text-decoration-none">Nog geen
                                    account? Registreer hier</a>
                            </div>
                            <a href="/reset-password"
                                class=" d-flex justify-content-center text-white font-weight-bold text-decoration-none">
                                Wachtwoord Vergeten?

                            </a>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
