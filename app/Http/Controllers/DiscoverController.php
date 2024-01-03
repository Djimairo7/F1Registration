<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\User; // Import the User model class
class DiscoverController extends Controller
{
    public function index(Request $request)
    {
        // USER PROFILE
        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $pointCount = $user->point_count;

        // GET USERS
        $query = $request->input('query');
        $sort = $request->input('sort', 'name'); // Default sort by name

        $users = User::where('name', 'LIKE', "%$query%")
            ->orderBy($sort)
            ->get();

        $allUsers = User::all(); // Retrieve all users

        return view('discover', compact('user', 'fullName', 'username', 'pointCount', 'users', 'allUsers', 'sort'));
    }
}
