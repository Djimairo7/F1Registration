<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $scores = Score::with('user')
            ->where('race_name', Str::slug(app('currentRace')['Circuit']['circuitName']))
            ->orderBy('score', 'asc')
            ->get();

        // Retrieve notifications of the current user
        $notifications = Notification::where('user_id', $user->id)->get();

        return view('home', compact('fullName', 'username', 'pointCount', 'races', 'drivers', 'notifications', 'scores'));
    }
}
