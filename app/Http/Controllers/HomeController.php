<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Http; // Import the Http facade
use Illuminate\Support\Facades\File; // Import the File facade
use Illuminate\Support\Str; // Import the Str facade

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

        $racesreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2024.json');
        $getRaces = $racesreq->json();

        $driversreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2023/drivers.json'); //2023 for testing purposes. 2024 gives nothing
        $getDrivers = $driversreq->json();

        // dd($getRaces, $getDrivers);

        // Get the corresponding race preview image for each race
        $raceImages = [];
        foreach ($getRaces['MRData']['RaceTable']['Races'] as $race) {
            $countryName = Str::slug($race['Circuit']['Location']['country']);
            $imageName = str_replace('-', '%20', Str::slug($race['Circuit']['Location']['country'])) . '.png'; //convert - to %20 for compatibility with the URL
            $imageUrl = 'https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/' . $imageName;
            $raceImages[$countryName] = $imageUrl;
        }

        return view('home', compact('fullName', 'username', 'pointCount', 'getRaces', 'getDrivers', 'raceImages'));
    }
}
