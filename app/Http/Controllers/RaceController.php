<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RaceController extends Controller
{
    public function show($raceName)
    {
        $user = Auth::user(); // Assign the authenticated user to the variable '$user'
        $fullName = $user->name;
        $username = $user->username;
        $points = $user->points;

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
        return view('race.show', compact('user', 'fullName', 'username', 'points', 'race', 'scores'));
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
