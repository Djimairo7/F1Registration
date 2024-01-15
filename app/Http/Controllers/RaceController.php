<?php

namespace App\Http\Controllers;

use App\Models\Score; // Import the Score class from the correct namespace
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Import the Request class from the correct namespace

class RaceController extends Controller
{
    //
    public function show($raceName)
    {
        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $pointCount = $user->point_count;

        $races = App::make('races');

        $race = collect($races)->first(function ($value) use ($raceName) {
            return Str::slug($value['Circuit']['circuitName']) == $raceName;
        });

        if (!$race) {
            abort(404);
        }

        // Get the leaderboard data

        $scores = Score::with('user')
            ->where('race_name', $raceName)
            ->orderBy('score', 'asc')
            ->get();
        return view('race.show', compact('user', 'fullName', 'username', 'pointCount', 'race', 'scores'));
    }
    public function submitScore(Request $request, $raceName)
    {
        $request->validate([
            'Time' => 'required|regex:/^\d\.\d{2}\.\d{3}$/',
            'UplRaceImg' => 'required|image',
        ]);

        $imagePath = $request->file('UplRaceImg')->getRealPath();
        $image = file_get_contents($imagePath);
        $base64Image = base64_encode($image);

        $score = new Score; // Create a new instance of the Score class

        $score->user_id = auth()->id();
        $score->race_name = $raceName;
        $score->score = $request->input('Time');
        $score->image = $base64Image;
        $score->save();

        return redirect()->back()->with('success', 'Score submitted successfully');
    }
}
