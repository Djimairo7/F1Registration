@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container p-3">
            <div class="row justify-content-center">
                <div class="col-md-12 bg-black text-white rounded overflow-hidden">
                    <div class="p-3">
                        <div class="text-center mb-3">
                            <button class="btn btn-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto fs-1"
                                    style="width: 350px; height: 350px;">
                                upload image
                            </button>
                        </div>
                        <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <input type="file" name="image" class="d-none"/>

                            <div class="form-group mb-3">
                                <label for="first_name" class="text-white">
                                    Voornaam
                                </label>
                                <input type="text" name="first_name" class="form-control bg-secondary text-white"/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="last_name" class="text-white">
                                    Achternaam
                                </label>
                                <input type="text" name="last_name" class="form-control bg-secondary text-white"/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="bio" class="text-white">
                                    Over mij
                                </label>
                                <textarea rows="4" name="bio" class="form-control bg-secondary text-white">
                            </textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-25 align-items-center d-flex justify-content-center mx-auto">
                                opslaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
