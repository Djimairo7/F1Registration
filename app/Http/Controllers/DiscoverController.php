<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
class DiscoverController extends Controller
{
    public function index()
    {
        // Retrieve all races from the database
        $races = Race::all();

        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $pointCount = $user->point_count;
        return view('discover', compact('fullName', 'username', 'pointCount'), ['races' => $races]);
    }
}
