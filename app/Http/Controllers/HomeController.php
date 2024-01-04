<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Http; // Import the Http facade
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

        // Retrieve all races from the database
        // $races = Race::all();

        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $pointCount = $user->point_count;

        $racesreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2024.json');
        $getRaces = $racesreq->json();

        $driversreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2023/drivers.json'); //2023 for testing purposes. 2024 gives nothing
        $getDrivers = $driversreq->json();

        // dd($getRaces, $getDrivers);

        // Return the view with all races
        return view('home', compact('fullName', 'username', 'pointCount', 'getRaces', 'getDrivers'));
    }
}
