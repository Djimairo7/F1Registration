<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\User; // Import the User model class
use App\Models\Notification; // Import the Notification model class

class DiscoverController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // USER PROFILE
            $user = Auth::user(); // Assign the authenticated user to the variable '$user'
            $username = $user->username;
            $pointCount = $user->point_count;

            // GET USERS
            $query = $request->input('query');

            $users = User::where('username', 'LIKE', "%$query%")
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

            // Notification::insert($notification);
            //*

            // Retrieve notifications of the current user
            $notifications = Notification::where('user_id', $user->id)->get();

            return view('discover', compact('user', 'notifications', 'username', 'pointCount', 'users', 'allUsers'));
        } else {
            // User is not authenticated, handle accordingly
            // For example, redirect to login page or show an error message
        }
    }
}
