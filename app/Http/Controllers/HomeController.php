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

        $response = Http::withoutVerifying()->get('https://api.openf1.org/v1/meetings'); // Make an HTTP GET request
        $races = $response->json(); // Retrieve the JSON response

        // Return the view with all races
        return view('home', compact('fullName', 'username', 'pointCount'), ['races' => $races]);
    }
}
