<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\User; // Import the User model class
use Illuminate\Support\Facades\App;

class DiscoverController extends Controller
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
    public function index(Request $request)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // USER PROFILE
            $user = Auth::user(); // Assign the authenticated user to the variable '$user'
            $fullName = $user->name;
            $username = $user->username;
            $pointCount = $user->point_count;

            $races = App::make('races');
            $drivers = App::make('drivers');
            $raceImages = App::make('raceImages');

            // GET search query
            $query = $request->input('query');

            // Retrieve users based on the search query
            $filteredUsers = User::where(
                'username',
                'LIKE',
                "%$query%"
            )->get();

            // Filter races based on the search query
            $filteredRaces = collect($races)->filter(function ($race) use ($query) {
                $raceName = $race['raceName'];
                $locality = $race['Circuit']['Location']['locality'];
                $circuitName = $race['Circuit']['circuitName'];
                $country = $race['Circuit']['Location']['country'];

                return stripos($raceName, $query) !== false ||
                    stripos($locality, $query) !== false ||
                    stripos($circuitName, $query) !== false ||
                    stripos($country, $query) !== false;
            })->values();

            // Filter drivers based on the search query
            $filteredDrivers = collect($drivers)->filter(function ($driver) use ($query) {
                $givenName = $driver['givenName'];
                $familyName = $driver['familyName'];
                $nationality = $driver['nationality'];

                return stripos($givenName, $query) !== false ||
                    stripos($familyName, $query) !== false ||
                    stripos($nationality, $query) !== false;
            })->values();

            $allUsers = User::all(); // Retrieve all users



            return view('discover', compact('user', 'filteredUsers', 'filteredRaces', 'filteredDrivers', 'allUsers', 'fullName', 'username', 'pointCount', 'races', 'drivers'));
        } else {
            // User is not authenticated, handle accordingly
            // For example, redirect to login page or show an error message
        }
    }
}
