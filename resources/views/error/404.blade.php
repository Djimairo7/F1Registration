@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container p-3">
            <div class="row justify-content-center">
                <div class="col-md-12 bg-black text-danger rounded overflow-hidden">
                    <div class="p-3">
                        <div class="d-flex justify-content-center">
                            <h1>404</h1>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if(isset($message) && $message)
                                <p>{{$message}}</p>
                            @else
                                <p>Helaas, de pagina waar je naar zoekt bestaat niet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
