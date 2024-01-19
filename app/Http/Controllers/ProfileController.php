<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{
    /**
     * Store a new profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $profile = null;
        if (!$user->profile) {
            $profile = $user->profile;
            // Return the profile create view
            return response()->view('profile.create', compact('profile'));
        }

        return response()->view('profile', compact('user'));
    }
    public function create()
    {
        $user = Auth::user();

        $profile = null;

        if ($user->profile) {
            $profile = $user->profile;
        }

        // Return the profile create view
        return response()->view('profile.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->profile) {
            throw new NotFoundHttpException('Er bestaat al een profiel voor deze gebruiker.');
        }

        // Validate the request data including the image
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'bio' => 'nullable',
            'profile_picture' => 'nullable|image',
        ]);



        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->getRealPath();
            $image = file_get_contents($imagePath);
            $base64Image = base64_encode($image);
            // Add the file path to the validated data
            $validatedData['profile_picture'] = $base64Image;
        }

        // Add the user ID to the validated data
        $validatedData['user_id'] = $user->id;

        // Create a new profile instance and save the validated data
        Profile::create($validatedData);

        // Redirect to a desired route (e.g., profile index) with a success message
        return redirect()->route('home')->with('success', 'Profiel succesvol aangemaakt!');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request data including the image
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'bio' => 'nullable',
            'profile_picture' => 'nullable|image',
        ]);

        if ($request->file('profile_picture')) {
            // Handle profile picture upload
            $imagePath = $request->file('profile_picture')->getRealPath();
            $image = file_get_contents($imagePath);
            $base64Image = base64_encode($image);
        }

        // Create a new profile instance and save the validated data
        $profile = $user->profile;

        if ($profile) {
            if ($request->file('profile_picture')) {
                $profile->profile_picture = $base64Image;
            }
            $profile->update();

            // Redirect to a desired route (e.g., profile index) with a success message
            return redirect()->route('profile')->with('success', 'Profiel succesvol ge-updatet!');
        } else {
            throw new NotFoundHttpException('Het profiel is niet gevonden. :(');
        }
    }
}
