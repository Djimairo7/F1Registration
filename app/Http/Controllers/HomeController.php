<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Http; // Import the Http facade
use Illuminate\Support\Str; // Import the Str facade
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $pointCount = $user->point_count;

        $races = App::make('races');
        $drivers = App::make('drivers');
        $raceImages = App::make('raceImages');

        return view('home', compact('fullName', 'username', 'pointCount', 'races', 'drivers', 'raceImages'));
    }
}
