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
    public function create()
    {
        $user = Auth::user();

        $profile = null;

        if ($user->profile){
            $profile = $user->profile;
        }

        // Return the profile create view
        return view('profile.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->profile){
            throw new NotFoundHttpException('Oeps! Er bestaat al een profiel voor deze gebruiker.');
        }

        // Validate the request data including the image
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'bio' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Store the file in the public storage and get the path
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            // Add the file path to the validated data
            $validatedData['profile_picture'] = $filePath;
        }

        // Add the user ID to the validated data
        $validatedData['user_id'] = $user->id;

        // Create a new profile instance and save the validated data
        $profile = Profile::create($validatedData);

        // Redirect to a desired route (e.g., profile index) with a success message
        return redirect()->route('home')->with('success', 'Profiel succesvol aangemaakt!');
    }

    public function update(Request $request){
        $user = Auth::user();

        // Validate the request data including the image
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'bio' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Store the file in the public storage and get the path
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            // Add the file path to the validated data
            $validatedData['profile_picture'] = $filePath;
        }

        // Create a new profile instance and save the validated data
        $profile = $user->profile;

        if ($profile){
            $profile->update($validatedData);

            // Redirect to a desired route (e.g., profile index) with a success message
            return redirect()->route('home')->with('success', 'Profiel succesvol ge-update!');
        }
        else {
            throw new NotFoundHttpException('Het profiel is niet gevonden. :(');
        }

    }
}
