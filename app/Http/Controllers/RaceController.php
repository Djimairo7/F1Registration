<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
            // Str::slug($value['raceName']);
            // Debugging code
            // dd(Str::slug($value['raceName']), $raceName);
            return Str::slug($value['Circuit']['circuitName']) == $raceName;
        });

        if (!$race) {
            abort(404);
        }

        return view('race.show', compact('user', 'fullName', 'username', 'pointCount', 'race'));
    }
}
