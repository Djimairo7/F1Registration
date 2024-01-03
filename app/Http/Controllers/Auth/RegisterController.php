<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        $attributes = request()->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:7|max:255'
        ]);

        User::create($attributes);

        return redirect('/');
    }
}
