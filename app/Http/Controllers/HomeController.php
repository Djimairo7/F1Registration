<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\Notification; // Import the Notification model class
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
        // USER PROFILE
        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $pointCount = $user->point_count;

        $races = App::make('races');
        $drivers = App::make('drivers');
        $raceImages = App::make('raceImages');
        $currentDate = App::make('currentDate');

        // Retrieve notifications of the current user
        $notifications = Notification::where('user_id', $user->id)->get();

        return view('home', compact('user', 'notifications', 'fullName', 'username', 'pointCount', 'currentDate', 'races', 'raceImages', 'drivers'));
    }
}
