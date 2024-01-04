<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\User; // Import the User model class
use App\Models\Notification; // Import the Notification model class
use Illuminate\Support\Facades\DB; // Import the DB facade

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

        //TODO: Fix notifications
        //*
        // Create a new notification for the logged-in user
        $notification = [
            'user_id' => $user->id,
            'message' => 'This is a test notification.',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Notification::insert($notification);
        //*

        // Retrieve notifications of the current user
        $notifications = Notification::where('user_id', $user->id)->get();

        return view('discover', compact('user', 'notifications', 'fullName', 'username', 'pointCount', 'users', 'allUsers', 'sort'));
    }
}
